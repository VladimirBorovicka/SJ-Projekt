<?php
require_once "include/classes/Products.php";

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_GET['id'])) {
    $delete = new Products();
    $delete->deleteProduct($_GET['id']);
}
?>