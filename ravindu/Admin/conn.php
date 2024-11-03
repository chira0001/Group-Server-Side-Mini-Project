<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "LibraryMS";

$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}



?>
