<!-- cart.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    
</body>
</html>
<?php
    session_start();

    include ("conn.php");

    if (!$conn->select_db($dbName)) {
        die("Database selection failed: " . $conn->error);
    }

    $result = $conn->query("SELECT * FROM BOOKS");
    echo '<link rel="stylesheet" type="text/css" href="all.css">';
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
        <th>Available Copies</th>
        <th>Operation</th>
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
                    <button><a href='update.php?isbn={$row['isbn']}'>Update</a></button><br><br>
                    <button onclick=\"confirmDelete('{$row['isbn']}')\">Delete</button><br><br>
                    
                </td>
            </tr>";
    }
    echo "</table>";
    echo "<center><button><a href='form.php'>Add Book</a></button><br><br></center>";
    $conn->close();
?>
<script>
    function confirmDelete(isbn) {
        if (confirm("Are you sure you want to delete this book?")) {
            window.location.href="delete.php?isbn=" + isbn;
        }
    }
</script>
