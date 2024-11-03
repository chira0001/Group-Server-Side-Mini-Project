<?php
session_start();
require_once('connection.php');
//include('test.php');
/*$userId = $_SESSION['user_id'];
$sql = "SELECT filename, file_type, file_data FROM uploads WHERE id = ?"; // You can modify the WHERE clause to fetch a specific image by ID or other criteria
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $imageId);
$imageId = 1; // Replace with the appropriate ID or variable
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($filename, $fileType, $fileData);

if ($stmt->num_rows > 0) {
    while ($stmt->fetch()) {
        header("Content-Type: $fileType");
        echo $fileData;
    }
} else {
    echo "No image found.";
}

$stmt->close();
$connect->close();*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Image</title>
    <style>
        img {
            width: 500px;
        }
    </style>
</head>

<body>
    <h1>Uploaded Image</h1>
    <img src="displayImage.php?id=1" alt="Uploaded Image">
</body>

</html>