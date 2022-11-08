<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('../../sendmail-phpmailer/PHPMailer/src/Exception.php');
require('../../sendmail-phpmailer/PHPMailer/src/PHPMailer.php');
require('../../sendmail-phpmailer/PHPMailer/src/SMTP.php');

function sendMail($email, $otp){
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = false; // Enable verbose debug output
        $mail->isSMTP(); // gửi mail SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'drunkindonut88@gmail.com'; // SMTP username
        $mail->Password = 'kfqztlwlpdepfkgs'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 587; // TCP port to connect to
        //Recipients
        $mail->setFrom('drunkindonut88@gmail.com', 'Drunkin Donut');
        $mail->addAddress($email, 'User'); // Add a recipient
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'OTP Code';
        $mail->Body = "Your DrunkinDonut's <b>OTP Code</b> is: $otp <br>
        <p>Thank you for chosing DrunkinDonut!!</p>
        <p>------------------------------------------------------</p>
        <p><i>Please do not reply to this email. 
        <br>Sincerely, 
        <br>DrunkinDonut </i>
        </p>";

        $mail->send();
    } catch (Exception $e) {
        header("Location: forget-password.php?error=Message could not be sent. Mailer Error: {$mail->ErrorInfo}.");
        exit();
    }
}

function sendNewOTP($email){
    $new_otp = createOTP();
    sendMail($email, $new_otp);
}