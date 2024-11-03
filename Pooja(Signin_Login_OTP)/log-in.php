<!DOCTYPE html>

<!--name = mysystemsign.php -->
<!--logging page / form action to mysystem2.php /create account button to mysystemsign.php-->

<?php require_once 'errorcontrol.php';?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel= "stylesheet" href = "style_sl_page.css">
    <!-- <style>
         body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0;
        }
        input {
            border: 1px solid black;
            border-radius: 5px;
            padding: 10px; 
            width:90%
            
        }
        button {
            cursor: pointer;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px 32px;
            background-color: #04AA6D;
            font-size: 16px;
            text-decoration: none;
            width: 90%;
        }
        table {
            border: 1px solid black;
            padding: 20px;
            /* margin-right: 30%;
            margin-left: 30%;
            margin-top: 10%; */
            border-collapse: collapse;
            width: 100%;
        }
        td {
            text-align: center;
            padding: 10px;
        }
        .alert {
            padding: 20px;
            background-color: #ffcccc;
            color: #b30000;
            border: none;
            text-align: center;
            margin-bottom: 5px;
          
        }
        
        h1 {
            text-align: center;
            font-size: 24px;
        }
        .container{
            width: 100%; 
            max-width: 500px; 
            margin: 0 auto; 
            padding: 20px;
            /* margin-right:600px ; */
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('pexels-pixabay-159711.jpg');
            background-size : cover;
             background-position : center;
           
        }
    </style> -->
</head>
<body>
<div class="container">
<form method = "POST" action="log-in.php">

<table>
    <tr colspan="2">
        <td >
            <h1>Log In</h1>
        </td>
    </tr>

    <tr colspan="2">
        <td >
            <?php if(count($errors) > 0): ?>
                <div class="alert">
                    <ul style="list-style-type: none; padding: 0;">
                        <?php foreach($errors as $showerror): ?>
                            <li><?php echo $showerror; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </td>
    </tr>

    <tr colspan="2">
        <td >
            <input type="email" name="email" placeholder="EMAIL" required>
        </td>
    </tr>

    <tr colspan="2">
        <td >
            <input type="password" name="password" placeholder="PASSWORD" required>
        </td>
    </tr>

    <tr colspan="2">
        <td >
            <button type="submit" name="login" style="width:45%;margin:10px;">Log In</button>
            <button type="submit" name="sign" style="width:45%;margin:10px;"><a href="sign-up.php" style="text-decoration: none; color: white;">Sign Up</a></button>
        </td>
    </tr>

    <tr colspan="2">
        <td >
            <a href="forgot_password.php">Forgot Password?</a>
        </td>
    </tr>
</table>

</form>

</div>

</body>
</html> 