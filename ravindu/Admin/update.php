<?php
    include 'conn.php';

    if (!$conn->select_db($dbName)) {
        die("Database selection failed: " . $conn->error);
    }
    
    echo '<link rel="stylesheet" type="text/css" href="all.css">';

    $isbn = isset($_GET['isbn']) ? 
    $_GET['isbn'] : '';

    if($isbn){
        $querry="select * from books where isbn = '$isbn'";
        $result = $conn -> query($querry);

        if($result -> num_rows > 0){
            $book = $result -> fetch_assoc();
        }else{
            echo"Book not found";
            exit();
        }
    }else{
        echo "No ISBN provided";
        exit();
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
      
        $title = $_POST['title'];
        $author = $_POST['author'];
        $pub = $_POST['pub'];
        $pub_year = $_POST['pub_year'];
        $genre = $_POST['genre'];
        $no_copy=$_POST['no_copy'];
        $lang=$_POST['lang'];
        $price = $_POST['price'];

        $sql = "update BOOKS
                set  title='$title', author='$author', publisher='$pub', 
                year_published='$pub_year', genre='$genre', language='$lang',price='$price' ,no_of_copies='$no_copy'
                where isbn='$isbn'";

        if ($conn->query($sql)===TRUE){
            echo "Record Update Successfull";
            header("Location: display.php");
            exit();
        } else{
            echo "Error".$conn->error;
        }       
    }  

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<table >
    <caption>Please fill all the fields</caption>
    <form action='' method='post'>
        <tr><td>ISBN:</td><th><input type='text' name='isbn' value='<?php echo $book["isbn"];?>'readonly></th></tr><br>
        <tr><td>Title: </td><th><input type='text' name='title' value='<?php echo $book["title"];?>'></th></tr><br>
        <tr><td>Author:</td><th> <input type='text' name='author' value='<?php echo $book["author"];?>'></th></tr><br>
        <tr><td>Publisher:</td><th> <input type='text' name='pub' value='<?php echo $book["publisher"];?>'></th></tr><br>
        <tr><td>Published_Year:</td><th> <input type='text' name='pub_year' value='<?php echo $book["year_published"];?>'></th></tr><br>
        <tr><td>No of copies:</td><th> <input type='number' name='no_copy' value='<?php echo $book["no_of_copies"];?>'></th></tr><br>
        <tr><td>Language:</td><th> <input type='text' name='lang' value='<?php echo $book["language"];?>'></th></tr><br>
        <tr><td>Price:</td><th> <input type='number' name='price' step='0.01'value='<?php echo $book["price"];?>'></th></tr><br>
        <tr><td>Genre:</td><th> <input type='text' name='genre' value='<?php echo $book["genre"];?>'></th></tr><br>
        <tr><td><input type='submit' value='Update'></td><td><input type='reset' value='Clear'></td></tr>
    </form>;

    </table>;
</body>
</html>