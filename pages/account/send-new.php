<?php
session_start();
require('../../sendmail-phpmailer/send-mail.php');
require('../../library/function.php');
include('../../database/dbcon.php');
$email = $_SESSION['email'];
if (isset($_POST['otp'])) {
    $insert_otp = $_POST['otp'];
    $correct_otp = $_SESSION['otp'];
    if (is_same_string($insert_otp, $correct_otp)) {
        $result = mysqli_query($con, "SELECT * FROM `account` where AccEmail = '$email'");
        $row = mysqli_fetch_array($result);
        $id = $row['AccountID'];
        $_SESSION['id'] = $id;
        header("Location: change-password.php");
        exit();
    } else{
        header("Location: otp-confirmation.php?error=Incorrect OTP.");
        exit();
    }
} else {
    unset($_SESSION["otp"]);
    sendNewOTP($email);
    header("Location: otp-confirmation.php?success=New OTP has been sent.");
    exit();
}