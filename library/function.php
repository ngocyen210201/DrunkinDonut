<?php
// check valid username
function is_username($username)
{
    $pattern = "/^[\w_]{6,32}$/";
    if (!preg_match($pattern, $username))
        return false;
    return true;
}

// check valid gmail
function is_email($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) > 64)
        return false;
    return true;
}

// check valid password
function is_password($password)
{
    $pattern = "/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\W])(?=\S*[\d])(?=\S{6,32})\S*$/";
    if (!preg_match($pattern, $password))
        return false;
    return true;
}
// $test = 'Ngocyen2102';
// if (!is_password($test)) {
//     echo $test;
//     echo "<br>";
//     echo "true";
// }else{
//     echo $test;
//     echo "<br>";
//     echo "false";
// }


// check valid telephone
function is_telephone($telephone)
{
    $pattern = "/^(\d){10}$/";
    if (!preg_match($pattern, $telephone))
        return false;
    return true;
}

// check for existed email or phone number
function is_existed($con, $check)
{
    $result = mysqli_query($con, "SELECT * FROM `account` where AccEmail = '$check' OR AccPhoneNo = '$check'");
    $num = mysqli_num_rows($result);
    if ($num == 1)
        return true;
    return false;
}

// check to log in (user)
function is_user_login($con, $eot, $password)
{
    $query = "SELECT * FROM `account`
    where (AccEmail = '$eot' && AccPassword = '$password') 
    OR (AccPhoneNo = '$eot' && AccPassword = '$password')";
    $result = mysqli_query($con, $query);
    $num = mysqli_num_rows($result);
    if ($num == 1)
        return true;
    return false;
}

// check to change password
function is_correct_password($con, $id, $password)
{
    $query = "SELECT * FROM `account`
    where AccountID = '$id' AND AccPassword = '$password'";
    $result = mysqli_query($con, $query);
    $num = mysqli_num_rows($result);
    if ($num == 1)
        return true;
    return false;
}

// check if 2 string is the same
function is_same_string($string1, $string2)
{
    if ($string1 == $string2)
        return true;
    return false;
}

// check positive number
function is_positive($number)
{
    if ($number >= 0)
        return true;
    return false;
}

// create OTP
function createOTP()
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $otp = '';
    for ($i = 0; $i < 6; $i++) {
        $otp .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $otp;
}

// get all
function getResult($con, $select, $table, $order, $condition, $get)
{
    $query = "SELECT $select FROM $table $condition $order ";
    $result = mysqli_query($con, $query);
    if ($get == 'row') {
        $row = mysqli_fetch_array($result);
    } elseif ($get == 'count') {
        $row = mysqli_num_rows($result);
    }
    return $row;
}

function getResultByQuery($con, $query, $get)
{
    $result = mysqli_query($con, $query);
    if ($get == 'row') {
        $row = mysqli_fetch_array($result);
    } elseif ($get == 'count') {
        $row = mysqli_num_rows($result);
    }
    return $row;
}

// update
function updateItem($con, $table, $update, $condition)
{
    $query = "UPDATE $table SET $update WHERE $condition";
    mysqli_query($con, $query);
}

// delete
function deleteItem($con, $table, $condition)
{
    $query = "DELETE FROM $table WHERE $condition";
    mysqli_query($con, $query);
}


