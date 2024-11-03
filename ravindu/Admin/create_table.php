<?php 
include("conn.php");

if (!$conn->select_db($dbName)) {
    die("Database selection failed: " . $conn->error);
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
    price float,
    no_of_copies INT
)";

if ($conn->query($tableSql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Table creation failed: " . $conn->error;
}

$conn->close();
?>
