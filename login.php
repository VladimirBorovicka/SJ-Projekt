<?php
require_once "include/classes/Users.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login = new Users();
        $result = $login->login($username, $password);

        if ($result === false) {
            echo "Invalid username or password.";
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
            <h2>Login</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="" required>
                    <span class="invalid-feedback"></span>
                </div>    
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-main" value="Login" name="submit">
                </div>
                <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
            </form>
        </div>
    </div>
    
    <?php
    include "include/footer.php";
    ?>

</body>
</html>