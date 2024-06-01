<?php
require_once "include/classes/Users.php";

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

$userData = new Users();
$userData = $userData->getUserData($_SESSION['user_id']);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
    $username = $_POST['username'] ?? null;
    $first_name = $_POST['first_name'] ?? null;
    $last_name = $_POST['last_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $editUser = new Users();
    $editUser->editUser($username, $first_name, $last_name, $email, $password, $_SESSION['user_id']);
}

if (isset($_POST['delete'])) {
    $deleteUser = new Users();
    $deleteUser->deleteUser($_SESSION['user_id']);
}

require_once "include/header.php";
?>
<body>

    <?php
    include "include/nav.php";
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
                <?php if ($_SESSION['role'] != 'admin'): ?>
                <div class="form-group">
                    <input type="submit" class="btn btn-main" value="Delete Account" name="delete" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
    
    <?php
    include "include/footer.php";
    ?>

</body>
</html>