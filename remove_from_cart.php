<?php
require_once 'include/classes/Cart.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_GET['index'])) {
    $item = $_GET['index'];
    $cart = new Cart();
    $cart->removeFromCart($item);

    header('Location: checkout.php');
    exit;
}

?>