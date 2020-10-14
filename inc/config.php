<?php
session_start();
ob_start();
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "test";
$prefix = "";
$mysqli = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database) or die("MYSQL'e baglanamadi");
$mysqli->set_charset("utf8");
date_default_timezone_set('Europe/Istanbul');
error_reporting(0);
?>