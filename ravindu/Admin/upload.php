<?php
    include "conn.php";

    if (!$conn->select_db($dbName)) {
        die("Database selection failed: " . $conn->error);
    }

    $statusMessage = "";
    $backlink = '<a href="./">Go Back</a>';
    $target_directory = 'Images/';
    $filename = basename($_FILES['file']["name"]);
    $target_file_path = $target_directory.$filename;
    $fileType = pathinfo($target_file_path,PATHINFO_EXTENSION);

    if(isset($_POST['submit']) && !empty($_FILES["file"]["name"])){

        $textName = $_POST['name'];
        $renamed_file_name = $target_directory.$textName.".".$fileType;
        $allowImageTypes = array('jpg','png','jpeg');
        if(!file_exists($renamed_file_name)){
            if(in_array($fileType,$allowImageTypes)){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $renamed_file_name)){
                $insertQry = "INSERT INTO images (file_name,uploaded_on) VALUES ('$renamed_file_name',now())";
                    $insertQry_result = mysqli_query($conn, $insertQry);
                    if($insertQry){
                        $statusMessage = "The file $textName.".".$fileType has been uploaded successfully.".$backlink;
                    }else{
                        $statusMessage = "File upload failed, Please try again. ". $backlink;
                    }
                }else{
                    $statusMessage = "Sorry, there was an error uploading your file. ". $backlink;
                }
            }else{
                $statusMessage = "Please try only jpg, png, jpeg files";
            }
        }else{
            $statusMessage = "The file $renamed_file_name is already exist.";
        }
    }else{
        $statusMessage = "Please select a file to upload.".$backlink;
    }
    echo $statusMessage;
?>