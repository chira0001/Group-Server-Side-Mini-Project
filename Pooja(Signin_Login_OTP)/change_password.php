<!DOCTYPE html>

<?php require_once 'errorcontrol.php';?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Document</title>
    <link rel= "stylesheet" href = "style_sl_page.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
</head>
<body>
<div class="container">
<form method = "POST" action="change_password.php">
<form method="POST" action="change_password.php">
        <table>
            <tr>
                    <td colspan="2">
                        <h1>Change Password</h1>
                    </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php if (count($errors) > 0): ?>
                        <div class='alert'>
                            <?php if (count($errors) == 1): ?>
                                <?php foreach ($errors as $showerror): echo $showerror; endforeach; ?>
                            <?php else: ?>
                                <ul style="list-style-type: none; padding: 0;">
                                    <?php foreach ($errors as $showerror): ?>
                                        <li><?php echo $showerror; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($alerts) && count($alerts) > 0): ?>
                        <div class="alert2">
                            <?php foreach ($alerts as $showalert): echo $showalert; endforeach; ?>
                        </div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="fpassword" placeholder="Password" 
                       pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}" 
                       title="Password  At least 8 characters, uppercase letter,lowercase letter,number and special character"
                        required>
                </td>
            </tr>
            <tr>
                <td>
                    <input  type="password" name="cpassword" placeholder="Confirm Password" required>
                    <button name="sign" id="loginButton" style="display: none; margin-top:5px;">
                        <a href="log-in.php" style="text-decoration: none; color: white;">Login</a>
                    </button> 
                </td>
            </tr>

            <tr colspan = "2">
                <td>
                    <button type="submit" name="update-new-pass">Change Password</button>
                </td>
            </tr>
           
        </table>
    </form>
</div>


<script>
$(document).ready(function() {
    // Check if the alert2 class is present
    if ($('.alert2').length > 0) {
        // Hide all other buttons except for the Login button
        $('button').not('#loginButton').hide();
        $('input').hide();
        $('h1').hide();
        $('#loginButton').show(); // Show the Login button
    }
});
</script>
</body>
</html>