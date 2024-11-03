<?php
session_start();
require_once('connection.php');
//$setEmail = $_SESSION['user_email'];

if (isset($_POST['submit'])) {
    $fileName = $_FILES["file"]["name"];
    $fileType = $_FILES["file"]["type"];
    $fileTmpName = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $check = getimagesize($fileTmpName);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($fileSize > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {

        $fileContent = addslashes(file_get_contents($fileTmpName));

        $sql = "INSERT INTO user (filename, file_type, file_data) VALUES ('$fileName', '$fileType', '$fileContent')";

        if ($conn->query($sql) === TRUE) {
            echo "The file " . htmlspecialchars($fileName) . " has been uploaded and stored in the database.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


$conn->close();
?>

CREATE TABLE uploads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    filename VARCHAR(255) NOT NULL,
    file_type VARCHAR(50),
    file_data LONGBLOB,
    upload_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);