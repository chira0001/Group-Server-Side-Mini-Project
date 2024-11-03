<?php
include 'conn.php';

if (!$conn->select_db($dbName)) {
    die("Database selection failed: " . $conn->error);
}


$isbn = isset($_GET['isbn']) ?
    $_GET['isbn'] : '';

$isbn_val = isset($_GET['isbn']) ?
    $_GET['isbn'] : '';

$directory = "Images/";
$filenameWithoutExtension = $isbn;

$files = scandir($directory);
$foundExtension = null;

foreach ($files as $file) {
    $fileInfo = pathinfo($file);
    
    if ($fileInfo['filename'] === $filenameWithoutExtension && isset($fileInfo['extension'])) {
        $foundExtension = $fileInfo['extension'];
        break;
    }
}

if ($foundExtension) {
    $deleting_file =$directory. $filenameWithoutExtension.".". $foundExtension;
    unlink($deleting_file);
    $file_delete_query = "DELETE FROM Images where file_name = '$deleting_file'";
    mysqli_query( $conn, $file_delete_query );
} else {
    echo "Not Found". $filenameWithoutExtension.".". $foundExtension;
}

$target_directory = 'Images/';
$textName = $isbn;
$fileType = pathinfo($textName, PATHINFO_EXTENSION);
$renamed_file_name = $target_directory . $textName . "." . $fileType;

if ($isbn) {

    $stmt = $conn->prepare("Delete from books where isbn = ?");
    $stmt->bind_param("s", $isbn);

    if ($stmt->execute()) {

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No ISBN Provided";
    $conn->close();
    exit();
}

$conn->close();
header("Location: display.php");
exit();
?>