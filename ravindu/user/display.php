<?php
// include "conn.php";
include "../../libraryms_conn.php";

// if (!$conn->select_db($dbName)) {
//     die("Database selection failed: " . $conn->error);
// }

$result = $conn->query("SELECT * FROM BOOKS");
echo '<link rel="stylesheet" type="text/css" href="all.css">';
include '../../nav.php';
echo '<link rel="stylesheet" href="../../navstyle.css">';
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
echo "<table border='1'>
    <tr>
    <th>ISBN</th>
    <th>Title</th>
    <th>Author</th>
    <th>Publisher</th>
    <th>Year</th>
    <th>Genre</th>
    <th>Language</th>
    <th>Price</th>
    <th>No of Copies</th>
    <th>Action</th>
    </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['isbn']}</td>
        <td>{$row['title']}</td>
        <td>{$row['author']}</td>
        <td>{$row['publisher']}</td>
        <td>{$row['year_published']}</td>
        <td>{$row['genre']}</td>
        <td>{$row['language']}</td>
        <td>{$row['price']}</td>
        <td>{$row['no_of_copies']}</td>
        <td>
            <form action='../../addToCart/cart.php' method='POST' style='display:inline;'>
                <input type='hidden' name='isbn' value='{$row['isbn']}'>
                <label for='quantity'>Qty:</label>
                <input type='number' name='quantity' size='5' min='1' max='{$row['no_of_copies']}' value='1' required>
                <button type='submit' name='add-to-cart' style='background-color:green;color:white;padding:5px;border:none;border-radius:4px;cursor:pointer';><i class='fas fa-cart-plus'></i> Add to Cart</button>
            </form>
        </td>
        </tr>";
}
echo "</table>";

$conn->close();
?>
