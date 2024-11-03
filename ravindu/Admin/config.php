<?php
$hostname = "localhost";
$username = "root";
$password = "";


$conn = new mysqli($hostname, $username, $password);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$DB_creation_Qry = "CREATE DATABASE IF NOT EXISTS LibraryMS";
if ($conn->query($DB_creation_Qry) === TRUE) {
    echo "Database created or already exists.<br>";
    
    $conn->select_db("LibraryMS");

    $createTable = "CREATE TABLE IF NOT EXISTS images (
        id INT(11) PRIMARY KEY AUTO_INCREMENT,
        file_name VARCHAR(255),
        uploaded_on DATETIME
    )";
    if ($conn->query($createTable) === TRUE) {
        echo "Table created or already exists.<br>";
    } else {
        echo "Table creation failed: " . $conn->error . "<br>";
    }
    $tableSql = "create table if not exists BOOKS (
        book_id INT AUTO_INCREMENT PRIMARY KEY,
        isbn VARCHAR(50) NOT NULL UNIQUE,
        title VARCHAR(100),
        author VARCHAR(100),
        publisher VARCHAR(100),
        year_published YEAR,
        genre VARCHAR(100),
        language VARCHAR(10),
        price float(7,2),
        no_of_copies INT
    )";
    
    if ($conn->query($tableSql) === TRUE) {
        echo "Book Table created successfully<br>";
    } else {
        echo "Book Table creation failed: " . $conn->error;
    }
} else {
    echo "Database creation failed: " . $conn->error . "<br>";
}

$conn->close();
?>
