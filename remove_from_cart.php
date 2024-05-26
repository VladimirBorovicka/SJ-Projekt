<?php
session_start();

if (isset($_GET['item'])) {
    $item = $_GET['item'];

    if (isset($_SESSION['cart'][$item])) {
        unset($_SESSION['cart'][$item]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

header('Location: checkout.php');
exit;
?>