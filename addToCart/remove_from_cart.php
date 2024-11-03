<?php
session_start();

if (isset($_POST['remove'])) {
    $isbn = $_POST['isbn'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['isbn'] === $isbn) {
            unset($_SESSION['cart'][$key]); 
            break;
        }
    }
}


header("Location: cart_display.php");
exit();
?>
