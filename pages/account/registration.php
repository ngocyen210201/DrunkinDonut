<?php

session_start ();
include('../../database/dbcon.php');
require('../../library/function.php');
//initialise variable
$name = $_POST['user'];
$email = $_POST['email'];
$tel = $_POST['telephone'];
$pass =  $_POST['password'];

if(is_existed($con, $tel) || is_existed($con, $email)){
    header("Location: register.php?error=Email or phone number has been registered.");
    exit();
}
elseif(!is_username($name)) {
    $error = "Invalid username. Username must include 6-32 characters and does not include symbols.";
    header("Location: register.php?error=$error");
	exit();
}elseif (!is_email($email)) {
    $error = "Invalid email. Email should include username(6-32 characters), @ and domain name(6-32 characters).";
    header("Location: register.php?error=$error");
	exit();
}elseif (!is_password($pass) || strlen($pass) > 32) {
    $error = "Invalid Password. Password must include 6-32 characters with at least 1 uppercase letter and 1 symbol.";
    header("Location: register.php?error=$error");
	exit();
}elseif (!is_telephone($tel)) {
    $error = "Invalid phone number. Please enter a sequence of 10 numbers.";
    header("Location: register.php?error=$error");
	exit();
}else{
    $decrypt_pass = md5($pass);
    mysqli_query($con, "insert into account(AccName, AccPassword, AccPhoneNo, AccEmail, RoleID) values ('$name', '$decrypt_pass', '$tel', '$email', '1')");
    $condition = "WHERE AccEmail = '$email'";
    $row = getResult($con, '*', 'Account', 'ORDER BY AccountID', $condition, 'row');
    $id = $row['AccountID'];
    $cartID = "cart" . $id;
    mysqli_query($con, "INSERT INTO Cart VALUES ('$cartID','$id' )");
    header("Location: register.php?success=Successfully Registered");
    exit();
}
?>