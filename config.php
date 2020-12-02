<?php
define('DB_SERVER', 'localhost:3308');
define('DB_USERNAME', 'simple');
define('DB_PASSWORD', 'simple');
define('DB_DATABASE', 'simple');
$dbcon = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); //Procedural Style usage
//$dbcon = new MySQLi(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); //OOP Style usage
?>