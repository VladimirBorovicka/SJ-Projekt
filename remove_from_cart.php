<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'include/classes/Cart.php';
session_start();

if (isset($_GET['index'])) {
    $item = $_GET['index'];
    $cart = new Cart();
    $cart->removeFromCart($item);

    header('Location: checkout.php');
    exit;
}

?>