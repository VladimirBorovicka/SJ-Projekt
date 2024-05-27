<?php
require_once "include/classes/Products.php";

if (isset($_GET['id'])) {
    $delete = new Products();
    $delete->deleteProduct($_GET['id']);
}
?>