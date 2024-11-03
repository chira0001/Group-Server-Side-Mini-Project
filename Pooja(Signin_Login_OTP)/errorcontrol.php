<?php
session_start();
require '../libraryms_conn.php'; 
require 'send.php';

// $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
// if ($conn->query($sql) === FALSE) {
//     echo "Error creating database: " . $conn->error;
// }

// $sql = "CREATE TABLE IF NOT EXISTS $dbname.signup_details(
    
//     firstname VARCHAR(50) NOT NULL,
//     lastname VARCHAR(50) NOT NULL,
//     email VARCHAR(100) NOT NULL,
//     password VARCHAR(100) NOT NULL, 
//     PRIMARY KEY (email)
// )";
// if ($conn->query($sql) === FALSE) {
//     echo "Error creating table: " . $conn->error;
// } 


$email = "";
$password = "";
$errors = array();
$alerts = array();


//for sing-up page
if(isset($_POST['register'])){
    $fname = mysqli_real_escape_string($conn,$_POST['first']);
    $lname = mysqli_real_escape_string($conn,$_POST['last']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['fpassword']);
    $con_password = mysqli_real_escape_string($conn,$_POST['cpassword']);

    if($password !== $con_password){
        $errors['password'] = "Passwords are not mached!";
    }

    $set_email = "SELECT * from signup_details WHERE email = '$email'";
    $run_set_email = mysqli_query($conn,$set_email);   // run the Query

    if(mysqli_num_rows($run_set_email)> 0){
       $errors['email'] = "Email that you entered is already insert!";
    }

    if(count($errors) == 0){

        // $data_insert = "INSERT INTO signup_details (fristname,lastname,email,password) VALUES('$fname','$lname','$email','$password')";
        // $run_data_insert = mysqli_query($connect,$data_insert);   //run the query

        // if($run_data_insert){
        //     header("location: log-in.php");
        // }

        // else{
        //     $errors['db-error'] = "Faild to insert data into database";
        // }

        //otp

        $to = $email;
        $subject = "verify-account-otp";
        $otp = rand(100000,999999);
        $message = strval($otp);

        if(sendEmail($to,$subject,$message)){
            $_SESSION["first-name"] = $fname;
            $_SESSION["last-name"] = $lname;
            $_SESSION["email"]= $email;
            $_SESSION["password"] = $password;
            $_SESSION["otp"] = $otp;
            $_SESSION["attempt"] = 1;
            header("location: otp-verify.php");
        }
        else{
            $errors["mail-error"] = "invalid email! failed to send confarmation email";
        }


    }
}

// for otp page
if(isset($_POST['verify_email'])){
    $otp = mysqli_real_escape_string($conn,$_POST['otp']);
    $send_otp = $_SESSION["otp"];
   
    if($otp == $send_otp){

        $data_insert = "INSERT INTO signup_details (firstname, lastname, email, password) VALUES('{$_SESSION['first-name']}', '{$_SESSION['last-name']}', '{$_SESSION['email']}', '{$_SESSION['password']}')";
        $run_data_insert = mysqli_query($conn,$data_insert);   

        if(!$run_data_insert){
            $errors['db-error'] = "Faild to insert data into database";
          
        }
        else{
           
            $to = $_SESSION['email'];
            $subject = "log-in";
            $message = "You are logging succsessfull to libary system,Use your email and password to loging to the system";

            if(sendEmail($to,$subject,$message)){
                unset($_SESSION['otp']);        //this is use because user press verify button againg it cause to erro
                // $alerts["otp-sucsess"] = "you are logging succsessfull to libary system,use your email and password to loging to the system";
               header("location: log-in.php"); 
            }
            else{
                $errors['otp-error1'] = "Fail to send confairmaition otp,click resend button to resend the otp";
            }
        }
    }
    else{
        $errors['otp-error2'] = "otp is not matched";
    }
}




//for resend otp
if(isset($_POST['resend'])){
    if($_SESSION["attempt"] <3){
        $_SESSION["attempt"] +=1;

        $otp = rand(100000,999999);
        $_SESSION["otp"] = $otp;

        $to = $_SESSION["email"];
        $subject = "Resend OTP";
        $message = $otp;

        if(sendEmail($to,$subject,$message)){
            $alerts["resend-otp"] = "Resend otp succsessfull to your email";
        }
        else{
            $errors['otp-resend-error'] = "Failed to send OTP.Please try again.";
        }

    }

    else{
        $errors['otp-exeed'] = "Your attempts is over!try next time";
    }

}



//for logging page
if(isset($_POST['login'])){
    
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $check_mail = "SELECT * FROM signup_details WHERE email = '$email' AND password = '$password'";
    $run_check_mail = mysqli_query($conn,$check_mail);

    if(mysqli_num_rows($run_check_mail) > 0){
        header("location: ../home.php");       //for user home page
    }

    else if($email === 'admin@gmail.com' AND $password === 'Admin@123'){
        header("location: ../admin_home.php");       //for admin home page
    }

    else{
        $errors['login-error'] = "Incorrect email or password!";
  
    }

}



//forgot change-password (next button in verify it's you table)

if(isset($_POST['change-password'])){
    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $mail = mysqli_real_escape_string($conn,$_POST['email']);

    $forgot_pass = "SELECT * FROM signup_details WHERE firstname = '$fname' AND lastname = '$lname' AND email= '$mail'";
    $run_forgot_pass = mysqli_query($conn,$forgot_pass);

    if(mysqli_num_rows($run_forgot_pass) > 0){
         $_SESSION['mail'] = $mail;
        header ("location: change_password.php"); 
    }
    else {
        $errors['email-valide'] = "Invalide details!please check your firsh name,last name or email";
    }

}

//for update password

if(isset($_POST['update-new-pass'])){
    $password = mysqli_real_escape_string($conn,$_POST['fpassword']);
    $con_password = mysqli_real_escape_string($conn,$_POST['cpassword']);

    if($password !== $con_password){
        $errors['password'] = "Passwords are not mached!";
    }
    else{

        $email = $_SESSION['mail'];
        $update_pass = "UPDATE signup_details SET password = '$password' WHERE email = '$email'";
        $run_update_pass = mysqli_query($conn,$update_pass);

        if( $run_update_pass){
            $info = "Your password is changed, now you can logging with your new password!";
            $_SESSION['info'] = $info ; 
            $alerts["change-pass-correct"] = $info;
        }
     
    }
}

?>