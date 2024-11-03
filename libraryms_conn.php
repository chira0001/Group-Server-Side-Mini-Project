<?php
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "libraryms";

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {

    die("connection failed: " . $conn->connect_error);

}

$createTable = "CREATE TABLE IF NOT EXISTS images (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    file_name VARCHAR(255),
    uploaded_on DATETIME
)";
if ($conn->query($createTable) === TRUE) {
    // echo "Table created or already exists.<br>";
} else {
    // echo "Table creation failed: " . $conn->error . "<br>";
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
    // echo "Book Table created successfully<br>";
} else {
    // echo "Book Table creation failed: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS $dbname.signup_details(
    
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
email VARCHAR(100) NOT NULL,
password VARCHAR(100) NOT NULL, 
PRIMARY KEY (email)
)";
if ($conn->query($sql) === FALSE) {
// echo "Error creating table: " . $conn->error;
} 


?>