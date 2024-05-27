<?php
require_once "include/classes/Users.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['firstname']) && isset($_POST['surname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new Users();
        $result = $user->register($firstname, $surname, $username, $email, $password);

        if ($result === false) {
            echo "Registration failed.";
        } else {
            header("Location: login.php");
            exit;
        }
    }
    else {
        echo "Please fill in all fields.";
    }
}
require_once "include/header.php";
?>
<body>

    <?php 
    include "include/nav.php";
    ?>
    
    <div class="container-login">
        <div class="wrapper">
            <h2>Register</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="" required>
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="firstname" class="form-control" value="" required>
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input type="text" name="surname" class="form-control" value="" required>
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-main" value="Register" name="submit">
                </div>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div>
    </div>

    <?php
    include "include/footer.php";
    ?>

</body>
</html>