<!DOCTYPE html>


<?php require_once 'errorcontrol.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verify</title>
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
        .alert2 {
            padding: 20px;
            background-color:  #00e673;
            color: white;
            border: none;
            text-align: center;
            margin-bottom: 5px;
            font-size:15px;
          
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
           
        }
    </style> -->
</head>
<body>
    <div class="container">
        <form method="POST" action="otp-verify.php">
            <table>
                <tr>
                    <td colspan="2">
                        <h1>OTP Verify</h1>
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
                    <td colspan="2">
                        <input type="text" name="otp" placeholder="Enter OTP">
                    </td>
                </tr>

              
                <tr>
                    <td>
                        <button type="submit" name="verify_email">Verify</button>
                    </td>
                    <td>
                        <button type="submit" name="resend">Resend</button>
                    </td>
                </tr>

               
                <tr>
                    <td colspan="2">
                        Already have an account? <a href="log-in.php">Login</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
