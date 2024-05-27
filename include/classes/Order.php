<?php
require_once 'connectDB.php';

class Order extends Database{
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function createOrder($user_id, $cartItems) {
        foreach ($cartItems as $game_id) {
            $sql = "INSERT INTO user_games (user_id, game_id) VALUES (:user_id, :game_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':game_id', $game_id);
            $result = $stmt->execute();
        }
    }
}
?>