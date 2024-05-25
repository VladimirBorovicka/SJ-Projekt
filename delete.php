<?php
require_once 'include/classes.php';
require_once 'connectDB.php';

if (isset($_GET['id'])) {
    $delete = new Products($conn);
    $delete->deleteProduct($_GET['id']);
}
?>