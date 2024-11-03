<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="./Danuja(homepage)/style.css">
</head>

<body>
    <div class="container">
        <section class="sec1">
            <div class="header">
                <nav>
                    <h1>Library Management System</h1>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="ravindu/user/display.php">Books</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="addToCart/cart_display.php"> Add to cart</a></li>
                    </ul>
                    <ul>
                        <li><a href="./Pooja(Signin_Login_OTP)/log-in.php">Login</a></li>
                        <li><a href="./Pooja(Signin_Login_OTP)/sign-up.php">Sign up</a></li>
                    </ul>
                </nav>
            </div>
            <div id="home">
                <h2>Welcome to Our Library</h2>
                <p class="secound">Discover a world of knowledge and resources at your fingertips.</p>
                <button><a href="./Chirath/Masonry.php">Browse Books</a></button>
            </div>
        </section>
    </div>


    <section class="sec2">
        <h2>Latest Books</h2>

        <?php

        include('libraryms_conn.php');

        $table = "SELECT * FROM books";
        $result = mysqli_query($link, $table);
        $count = mysqli_num_rows($result);

        if (mysqli_num_rows($result) == 0) {

            echo "No data added <br>";
        } else {

            echo "<div class='book_container'>";
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {

                echo '<div class = "book"><img  class = "book_img" src= ' . $row['photo'] . '><p> ' . $row['title'] . '</p><p class ="dates">' . $row['published_date'] . '</p></div>';

            }

            echo "</div>";
        }
        ?>


    </section>
    <footer>
        <p>&copy; 2024 Library Management System</p>

    </footer>
</body>

</html>