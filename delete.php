<?php
require_once 'include/classes.php';

if (isset($_GET['id'])) {
    $delete = new Products();
    $delete->deleteProduct($_GET['id']);
}
?>