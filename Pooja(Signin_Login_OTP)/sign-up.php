<!DOCTYPE html>

<!--name= mysystemsign.php -->
<!--signup page  / form action to mysystem1.php /logging button to mysystemlog.php-->

<?php require 'errorcontrol.php';?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel= "stylesheet" href = "style_sl_page.css">
   
</head>
<body>
<div class ="container" >
<form method = "POST" action="sign-up.php">
<table>
                <tr>
                    <td colspan="2">
                        <h1>Sign Up</h1>
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
                <tr>
                    <td>
                        <input type="text" name="first" placeholder="FIRST NAME" pattern="[A-Za-z\s-]+" title="Name can only contain letters, spaces, or hyphens" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="last" placeholder="LAST NAME" pattern="[A-Za-z\s-]+" title="Name can only contain letters, spaces, or hyphens" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="email" name="email" placeholder="EMAIL" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="fpassword" placeholder="PASSWORD" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}" title="Password  At least 8 characters, uppercase letter,lowercase letter,number and special character" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="cpassword" placeholder="CONFIRM PASSWORD" required>
                    </td>
                </tr>
                <tr> 
                    <td>
                        <button type="submit" name="register">Submit</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        Already have an account? <a href="log-in.php">Login</a>
                    </td>
                </tr>
            </table>
   
</form>

</div>

</body>
</html>