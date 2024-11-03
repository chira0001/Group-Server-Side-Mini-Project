<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Cart</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php
session_start();
include 'conn.php';

if (!isset($conn)) {
    die("<h2>Database connection failed. Please check your conn.php file.</h2>");
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<form action='../ravindu/user/display.php' method='GET'>
        <button type='submit'>
            <i class='fa-solid fa-backward style='color: green;''></i>
        </button>
    </form>";
    echo "<h1>Your cart is empty.</h1>";
    exit();
}

echo "<form action='../ravindu/user/display.php' method='GET'>
    <button type='submit'>
        <i class='fa-solid fa-backward style='color: green;''></i>
    </button>
</form>";
echo "<h1>BOOK SHELF</h1>";
echo "<table border='1' style='border-collapse:collapse; width: 100%;'>
        <tr>
            <th>ISBN</th>
            <th>Title</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>";

$total = 0;

//item in the cart
foreach ($_SESSION['cart'] as $item) {
    $subtotal = $item['subtotal'];
    $total += $subtotal;

    
    $stmt = $conn->prepare("SELECT title FROM BOOKS WHERE isbn = ?");
    $stmt->bind_param("s", $item['isbn']);
    $stmt->execute();
    $bookResult = $stmt->get_result();
    $bookTitle = '';
    if ($bookRow = $bookResult->fetch_assoc()) {
        $bookTitle = $bookRow['title'];
    }

    echo "<tr>
            <td>{$item['isbn']}</td>
            <td>{$bookTitle}</td>
            <td>{$item['quantity']}</td>
            <td>Rs. {$item['price']}</td>
            <td>Rs. {$subtotal}</td>
            <td>
                <form action='remove_from_cart.php' method='POST' style='display:inline;'>
                    <input type='hidden' name='isbn' value='{$item['isbn']}'>
                    <button type='submit' name='remove' class='remove-btn'><i class='fa-solid fa-xmark'></i></button>
                </form>
            </td>
          </tr>";
}


echo "<tr>
        <td colspan='4' style='text-align:left;'><strong>Total:</strong></td>
        <td><strong>Rs. {$total}</strong></td>
        <td><button class='check-out-btn' onclick=\"window.location.href='checkout.php';\">CHECKOUT</button></td>
      </tr>";


echo "</table>";

?>

</body>
</html>
