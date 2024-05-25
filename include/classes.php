<?php

require_once 'include/connectDB.php';

class Users extends Database {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role'];
                header("Location: index.php");
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function register($firstname, $surname, $username, $email, $password) {
        $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = 'user';
        $sql = "INSERT INTO users (first_name, surname, username, email, password, role) VALUES (:firstname, :surname, :username, :email, :password, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>