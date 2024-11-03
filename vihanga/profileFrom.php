<?php
session_start();
require_once('connection.php');
$setEmail = $_SESSION["email"];
echo $setEmail;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email'])) {
        if ($_POST['pass'] == $_POST['re-pass']) {
            $fName = $_POST['fName'];
            $lName = $_POST['lName'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $phone = $_POST['phone'];

            $quary_1 = "UPDATE signup_details SET
                    lastname = '$lName',
                    firstname = '$fName',
                    password = '$password',
                    email = '$email'
                    WHERE email = '$setEmail';";
            $count = 1;
            $quary_3 = "SELECT * FROM user;";
            $resualt = mysqli_query($conn, $quary_3);
            if (mysqli_num_rows($resualt) > 0) {
                while ($userData = mysqli_fetch_assoc($resualt)) {
                    if ($userData['user_email'] == $setEmail) {
                        $quary = "UPDATE user 
                                    SET phone = '$phone'
                                    WHERE user_email = '$email';";
                        mysqli_query($conn, $quary);
                        $count++;
                    }
                }
            }
            if ($count == 1) {
                $quary_4 = "INSERT INTO user (user_email, phone) VALUES('$email','$phone');";
                mysqli_query($conn, $quary_4);
            }

            $resualt_1 = mysqli_query($conn, $quary_1);
            if ($resualt_1) {
                echo "<script> alert('Thank You'); </script>";
                header('Location:profile.php?');
            }

        } else {
            $error = "Password doesn't match";
        }
    } else {
        echo "<script> alert('Something wrong..!'); </script>";
    }
} else {
    echo "<script> alert('ERORR_x0003_%'); </script>";
    header('Location:home.php?_ERROR_code:_x0003');
}
?>