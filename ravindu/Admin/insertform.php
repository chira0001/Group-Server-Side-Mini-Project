<?php

$dbName = "LibraryMS";
include 'conn.php';
mysqli_select_db($conn, $dbName);

if (empty($_POST['isbn']) || empty($_POST['title']) || empty($_POST['author']) || empty($_POST['no_copy']) || empty($_POST['pub']) || empty($_POST['pub_year']) || empty($_POST['lang']) || empty($_POST['genre']) || empty($_FILES['file']["name"])|| empty($_POST["price"])) {
    echo "Please fill all the fields";
    
} else {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $pub = $_POST['pub'];
    $pub_year = $_POST['pub_year'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $no_copy = $_POST['no_copy'];
    $lang = $_POST['lang'];

    if (!preg_match('/^\d{5}|\d{13}$/', $isbn)) {
        echo '<script>alert("Please enter a valid 10 or 13 digit ISBN");</script> ';
        echo '<script>setTimeout(function(){window.location.href="form.php";},100);</script>';
        exit();
    }
    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $title) || strlen($title) < 2) {
        echo '<script>alert("Please enter a valid Title (minimum 2 characters)");</script> ';
        echo '<script>setTimeout(function(){window.location.href="form.php";},100);</script>';
        exit();
    }
    if (!preg_match("/^[a-zA-Z0-9 .'-]+$/", $author)) {
        echo '<script>alert("Please enter a valid Author name ");</script> ';
        echo '<script>setTimeout(function(){window.location.href="form.php";},100);</script>';
        exit();
    }
    if (!preg_match("/^[a-zA-Z0-9 .'-]+$/", $pub)) {
        echo '<script>alert("Please enter a valid Publishername");</script> ';
        echo '<script>setTimeout(function(){window.location.href="form.php";},100);</script>';
        exit();
    }
    $current_year = date('Y');
    if ($pub_year < 1000 || $pub_year > $current_year) {
        echo '<script>alert("Please enter a valid Publish year");</script> ';
        echo '<script>setTimeout(function(){window.location.href="form.php";},100);</script>';
        exit();
    }
    if (!preg_match("/^[a-zA-Z]+$/", $genre)) {
        echo '<script>alert("Please enter a valid genre ");</script> ';
        echo '<script>setTimeout(function(){window.location.href="form.php";},100);</script>';
        exit();
    }
    if (!preg_match("/^[0-9]+$/", $no_copy) || $no_copy <= 0) {
        echo '<script>alert("Please enter a valid number of copies ");</script> ';
        echo '<script>setTimeout(function(){window.location.href="form.php";},100);</script>';
        exit();
    }
    if (!preg_match("/^[a-zA-Z]+$/", $lang)) {
        echo '<script>alert("Please enter a valid Language");</script> ';
        echo '<script>setTimeout(function(){window.location.href="form.php";},100);</script>';
        exit();
    }
    if(!filter_var($price,FILTER_VALIDATE_FLOAT)){
        echo '<script>alert("Please enter a valid Price");</script> ';
        echo '<script>setTimeout(function(){window.location.href="form.php";},100);</script>';
        exit();
    }

    $sql = "insert into BOOKS (isbn, title, author, publisher, year_published, genre, language,price, no_of_copies)
                values ('$isbn','$title','$author','$pub','$pub_year','$genre','$lang','$price','$no_copy')";

    if ($conn->query($sql) === TRUE) {
        echo "Record add Successfull";
    } else {
        echo "Record add  Not Successfull" . $conn->error;
    }

    if (isset($_POST['submit']) && !empty($_FILES['file']["name"])) {
        $isbn_val = $_POST["isbn"];
        $statusMessage = "";
        $target_directory = 'Images/';
        $filename = basename($_FILES['file']['name']);
        $fileType = pathinfo($filename, PATHINFO_EXTENSION);
        $renamed_file_name = $target_directory . $isbn_val . "." . $fileType;
        $allowedImageTypes = array('jpg', 'png', 'jpeg');

        if (!file_exists($renamed_file_name)) {
            if (in_array($fileType, $allowedImageTypes)) {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $renamed_file_name)) {
                    $insertQry = "INSERT INTO images (file_name, uploaded_on) VALUES ('$renamed_file_name', NOW())";
                    if (mysqli_query($conn, $insertQry)) {
                        $statusMessage = "The file $isbn_val.$fileType has been uploaded successfully.";
                    } else {
                        $statusMessage = "File upload failed: " . mysqli_error($conn);
                    }
                } else {
                    $statusMessage = "Error uploading file.";
                }
            } else {
                $statusMessage = "Please upload only JPG, PNG, or JPEG files.";
            }
        } else {
            $statusMessage = "The file $renamed_file_name already exists.";
        }
    } else {
        $statusMessage = "Please select a file to upload.";
    }

    echo $statusMessage;
    
    header("Location: display.php");
    exit();
}

$conn->close();
?>