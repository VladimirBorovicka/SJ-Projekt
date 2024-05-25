<?php
require_once 'include/classes.php';
require_once 'include/connectDB.php';

if (isset($_GET['id'])) {
    $delete = new Products();
    $delete->deleteProduct($_GET['id']);
}
?>