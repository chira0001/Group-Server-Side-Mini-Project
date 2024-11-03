<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: index.php"); 
    exit();
}

$totalPrice = 0;
foreach ($_SESSION['cart'] as $product) {
    $productCost = $product['price'] ?? 0;
    $productQuantity = $product['quantity'] ?? 1;
    $subTotal = $productCost * $productQuantity;
    $totalPrice += $subTotal;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="checkout-container">
    <h1>Checkout</h1>

    <div class="cart-summary">
        <h2>Order Summary</h2>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['isbn']); ?></td>
                    <td>Rs. <?php echo number_format($product['price'], 2); ?></td>
                    <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                    <td>Rs. <?php echo number_format($product['price'] * $product['quantity'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" class="total-price">Total:</td>
        
                <td>Rs. <?php echo number_format($totalPrice, 2); ?></td>
            </tr>
        </table>
    </div>

    <div class="shipping-info">
        <h2>Shipping Information</h2>
        <form action="process_order.php" method="POST">
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="text" name="city" placeholder="City" required>
            <input type="text" name="state" placeholder="Country" required>
            <input type="text" name="zip" placeholder="ZIP Code" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="phone" placeholder="Phone Number" required>
            <button type="submit" class="checkout-btn">Place Order</button>
        </form>
    </div>
</div>

</body>
</html>
