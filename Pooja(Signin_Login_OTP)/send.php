<?php

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//this is function to send emails
function sendEmail($to, $subject, $message) {
  
    $mail = new PHPMailer(true);

    try {
        //Server
        $mail->SMTPDebug = SMTP::DEBUG_OFF;              
        $mail->isSMTP();                                   // Send using  the SMTP
        $mail->Host       = 'smtp.gmail.com';             
        $mail->SMTPAuth   = true;                          
        $mail->Username   = 'jayarathnahpj23@gmail.com';          // SMTP username
        $mail->Password   = 'bxqg djpu uyho ganr';         
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   
        $mail->Port       = 465;                           

        //sender details
        $mail->setFrom('jayarathnahpj23@gmail.com', 'Mailer');     
        $mail->addAddress($to);                            

        // Content
        $mail->isHTML(true);                             //format HTML
        $mail->Subject = $subject;                         // Set the mail  subject
        $mail->Body    = $message;                         // Set the HTML message body
        $mail->AltBody = strip_tags($message);            

        $mail->send();                                 //send the email
        return "Message has been sent";
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
