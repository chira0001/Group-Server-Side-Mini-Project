<!DOCTYPE html>



<?php require_once 'errorcontrol.php';?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel= "stylesheet" href = "style_sl_page.css">
    
    </style> 
    </style>
</head>
<body>
<div class = "container">
<form method="POST" action="forgot_password.php">
    <table>
        <tr>
            <td colspan="2">
                <h1>Verify Is's You</h1>
            </td>
            
        </tr>

        <tr>
            <td colspan="2">
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

        <tr colspan ="2">
            <td>
                <input type="text" name="fname" placeholder="First Name" required>
            </td>
           
        </tr>
        <tr colspan ="2">
            <td>
                <input type="text" name="lname" placeholder="Last Name" required>
            </td>
           
        </tr>
        <tr colspan ="2">
            <td>
                <input type="email" name="email" placeholder="EMAIL" required>
            </td>
           

        </tr>

        <tr colspan  = "2">
            <td>
                <button name="sign" style="width:45%;margin:10px;"><a href="log-in.php" style="text-decoration: none; color: white;">Back</a></button>
                <button type="submit" name="change-password" style="width:45%;margin:10px;">Next</button>
            </td>
        </tr>
    
    </table>
</form>
</div>
</body>
</html>
