<?php
require_once "include/connectDB.php";
require_once "include/classes.php";

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Electro - HTML Ecommerce Template</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
</head>

<body>
    <?php
    include "include/header.php";
    ?>

    <div class="container-login">
        <div class="wrapper">
            <h2>Login</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="">
                    <span class="invalid-feedback"></span>
                </div>    
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
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