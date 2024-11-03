<?php
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


function addToCart($isbn, $quantity, $price) {
    
    foreach ($_SESSION['cart'] as $item) {
        if ($item['isbn'] === $isbn) {
            
            $item['quantity'] += $quantity;
            $item['subtotal'] = $item['price'] * $item['quantity'];
            return; 
        }
    }

    
    $_SESSION['cart'][] = [
        'isbn' => $isbn,
        'quantity' => $quantity,
        'price' => $price,
        'subtotal' => $price * $quantity //  subtotal
    ];
}

// Check if form was submitted
if (isset($_POST['add-to-cart'])) {
    $isbn = $_POST['isbn'];
    $quantity = (int)$_POST['quantity'];

    
    include "conn.php"; 

    if (!$conn->select_db($dbName)) {
        die("Database selection failed: " . $conn->error);
    }

    
    $stmt = $conn->prepare("SELECT price FROM BOOKS WHERE isbn = ?");
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $price = (float)$row['price']; 
        addToCart($isbn, $quantity, $price); 

        
        header("Location: cart_display.php");
        exit();
    } else {
        echo "Error: Book not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
