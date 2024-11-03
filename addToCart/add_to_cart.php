<?php
session_start();
include 'conn.php';
 
if (isset($_POST['isbn'], $_POST['title'], $_POST['price'], $_POST['quantity'])) {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $price = (float)$_POST['price'];
    $quantity = (int)$_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$isbn])) {
        $_SESSION['cart'][$isbn]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$isbn] = [
            'title' => $title,
            'price' => $price,
            'quantity' => $quantity,
        ];
    }

    $_SESSION['message'] = "$title has been added to the cart.";
} else {
    $_SESSION['message'] = "Failed to add product to cart. Missing data.";
}

header("Location: ../../ravindu/user/display.php");
exit();
?>
