<?php
    // include "config.php";
    include "../libraryms_conn.php";

    if(isset($_POST['input'])){
        $input = $_POST['input'];

        $query = "SELECT * FROM books WHERE title LIKE '{$input}%' OR isbn LIKE '{$input}%' OR author LIKE '{$input}%' OR publisher LIKE '{$input}%' OR year_published LIKE '{$input}%' OR genre LIKE '{$input}%' OR language LIKE '{$input}%'";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
?>
            <table border="1" style="border-collapse:collapse">
                <tr>
                    <th>Book ID</th>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Year Published</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>No_of_copies</th>
                </tr>
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $b_id = $row['book_id'];
                        $b_isbn = $row['isbn'];
                        $b_title = $row['title'];
                        $b_author = $row['author'];
                        $b_publisher = $row['publisher'];
                        $b_year_published = $row['year_published'];
                        $b_genre = $row['genre'];
                        $b_language = $row['language'];
                        $b_no_of_copies = $row['no_of_copies'];
                ?>
                <tr>
                    <td><?php echo $b_id;?></td>
                    <td><?php echo $b_isbn;?></td>
                    <td><?php echo $b_title;?></td>
                    <td><?php echo $b_author;?></td>
                    <td><?php echo $b_publisher;?></td>
                    <td><?php echo $b_year_published;?></td>
                    <td><?php echo $b_genre;?></td>
                    <td><?php echo $b_language;?></td>
                    <td><?php echo $b_no_of_copies;?></td>
                </tr>
                
                <?php
                    }
                ?>
            </table>
<?php
        }else{
            echo "<h6>No data found</h6>";
        }
    }
?>