<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    
</body>
</html>
<?php
session_start();

include 'conn.php';
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: ../ravindu/user/display.php"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $fullName = htmlspecialchars(trim($_POST['full_name']));
    $address = htmlspecialchars(trim($_POST['address']));
    $city = htmlspecialchars(trim($_POST['city']));
    $state = htmlspecialchars(trim($_POST['state']));
    $zip = htmlspecialchars(trim($_POST['zip']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));

    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $product) {
        $productCost = $product['price'] ?? 0;
        $productQuantity = $product['quantity'] ?? 1;
        $totalPrice += $productCost * $productQuantity;
    }

    unset($_SESSION['cart']);
    
    //data store to the database

    //create database
    $sql = "CREATE TABLE IF NOT EXISTS order_summary(
               order_id int primary key AUTO_INCREMENT, 
               order_name varchar(100), 
               order_address varchar(200),
               order_city varchar(50),
               order_country varchar(30),
               order_zip_code int,
               order_email varchar(50),
               order_ph_no int
            )";
    if(!mysqli_query($conn,$sql)){
        echo "Cant create order summary table";
    }
    
    //use order_summary
    $db_selected = mysqli_select_db($conn, $dbName);

    if (!$db_selected) {
        die("Could not select database: " . mysqli_error($conn));
    }

    //insert data
    $sql = "INSERT INTO order_summary (order_id,order_name, order_address, order_city, order_country, order_zip_code, order_email, order_ph_no) VALUES ('',?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn,$sql);
    
    if($stmt){
        mysqli_stmt_bind_param($stmt, 'ssssssi', $fullName, $address, $city, $state, $zip, $email, $phone);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    

    echo "<h1>Order Confirmation</h1>";
    echo "<p>Thank you, <strong>{$fullName}</strong>, for your order!</p>";
    echo "<p>Order Total: <strong>Rs. " . number_format($totalPrice,2) . "</strong></p>";
    echo "<h2>Shipping Details</h2>";
    echo "<p><strong>Address:</strong> {$address}, {$city}, {$state}, {$zip}</p>";
    echo "<p><strong>Email:</strong> {$email}</p>";
    echo "<p><strong>Phone:</strong> {$phone}</p>";
    echo "<p>We will send a confirmation email shortly.</p>";
    echo "<button class='check-out-btn'><a href='../home.php' style='text-decoration:none;'>Back to Home</button></a>";
} else {

    header("Location: checkout.php");
    exit();
}
mysqli_close($conn);
?>
