<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'vlado');
define('DB_PASSWORD', '7-Y]Ys!E*l2wxy.M');
define('DB_NAME', 'store');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>