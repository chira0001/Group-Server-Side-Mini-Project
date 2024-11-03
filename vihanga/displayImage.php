<?php
require_once('connection.php');
session_start();
$userId = 1; // Replace this with a variable if you want to dynamically fetch user ID

// Fetch image data from the database
$sql = "SELECT filename, file_type, file_data FROM user WHERE user_id = ?"; // Make sure your WHERE clause is set properly
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($filename, $fileType, $fileData);

if ($stmt->num_rows > 0) {
    while ($stmt->fetch()) {
        // Set content type for the image
        header("Content-Type: $fileType");
        echo $fileData; // Output the image data directly
    }
} else {
    echo "No image found.";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
