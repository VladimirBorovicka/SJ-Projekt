<?php
require_once "include/connectDB.php";
require_once "include/classes.php";

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

$userData = new Users();
$userData = $userData->getUserData($_SESSION['user_id']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? null;
    $first_name = $_POST['first_name'] ?? null;
    $last_name = $_POST['last_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $editUser = new Users();
    $editUser->editUser($username, $first_name, $last_name, $email, $password, $_SESSION['user_id']);
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
            <h2>Edit User</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $userData['username']; ?>">
                    <span class="invalid-feedback"></span>
                </div>   
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo $userData['first_name']; ?>">
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo $userData['surname']; ?>">
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $userData['email']; ?>">
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-main" value="Save Changes" name="submit">
                </div>
            </form>
        </div>
    </div>
    
    <?php
    include "include/footer.php";
    ?>
</body>
</html>