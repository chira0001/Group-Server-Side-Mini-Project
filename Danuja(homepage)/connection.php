<?php
$host = "localhost";
$username = "root";
$password = "";

$link = mysqli_connect($host, $username, $password, "php", 3307);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$db_check = mysqli_select_db($link, 'php');

if (!$db_check) {
    echo "Database is not exsist";
    exit(1);
}

$db_selected = mysqli_select_db($link, "php");
if (!$db_selected) {
    die("Can't use 'bict': " . mysqli_error($link));
}

?>