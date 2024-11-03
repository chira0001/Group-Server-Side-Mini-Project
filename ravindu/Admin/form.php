<?php
    include "conn.php";
    echo '<link rel="stylesheet" type="text/css" href="all.css">';

    echo "<table >";
    echo "<caption>Please fill all the fields</caption>";
    echo"<form action='insertform.php' method='post' enctype='multipart/form-data'>
        <tr><td>ISBN:</td><th><input type='text' name='isbn'></th></tr><br>
        <tr><td>Title: </td><th><input type='text' name='title'></th></tr><br>
        <tr><td>Author:</td><th> <input type='text' name='author'></th></tr><br>
        <tr><td>Publisher:</td><th> <input type='text' name='pub'></th></tr><br>
        <tr><td>Published_Year:</td><th> <input type='text' name='pub_year'></th></tr><br>
        <tr><td>No of copies:</td><th> <input type='number' name='no_copy'></th></tr><br>
        <tr><td>Price:</td><th> <input type='number' name='price' step='0.01'></th></tr><br>
        <tr><td>Language:</td><th> <input type='text' name='lang'></th></tr><br>
        <tr><td>Genre:</td><th> <input type='text' name='genre'></th></tr><br>
        <tr><td>Image:</td><th> <input type='file' name='file' id='imageInput' accept='image/*'><br><br>
                    <img id='imagePreview' src='#' alt='Image Preview' style='display: none; width: 200px; height: auto;'/></th></tr><br>
        <tr><td><input type='submit' value='Add' name='submit'></td><td><input type='reset' value='Clear'></td></tr>
        </form>";

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
            $filename = basename($_FILES['file']['name']);
        }

        echo "</table>";
    ?>

    <script>
        document.getElementById("imageInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                        const imagePreview = document.getElementById("imagePreview");
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = "block";
                    };
                reader.readAsDataURL(file);
            }
        });
    </script>
    

