<?php
 

    $dbservername = "localhost";
    $dbusername ="root";
    $dbpassword = "";
    $dbname = "libraryms";
    $port = 3307;


    $conn = mysqli_connect( $dbservername, $dbusername,$dbpassword , $dbname,$port);

    if($conn->connect_error){
    
        die("connection failed: ".$conn->connect_error); 
    
    }
?>

