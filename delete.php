<?php
require_once "include/classes/Products.php";

session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: index.php');
}

if (isset($_GET['id'])) {
    $delete = new Products();
    $delete->deleteProduct($_GET['id']);
}
?>