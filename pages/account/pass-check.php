<?php
session_start();
include('../../database/dbcon.php');
require('../../library/function.php');
//initialise variable
$id = $_SESSION['id'];
$new_pass =  $_POST['new_pass'];
$new_pass1 =  $_POST['new_pass1'];
// nếu có id người dùng và email hoặc sđt người dùng
if (isset($_SESSION['id']) && isset($_SESSION['eot'])) {
    //check các điều kiện thỏa mãn để đổi pass 
    // check xem password mới có valid ko
    if (is_password($new_pass)) {
        $old_pass = $_POST['old_pass'];
        // check xem pass mới và pass cũ có trùng nhau ko
        if (!is_same_string($old_pass, $new_pass)) {
            // check xem pass mới và confirm pass có khớp ko
            if (is_same_string($new_pass, $new_pass1)) {
                // check xem pass cũ có đúng ko
                $encode_old_pass = md5($old_pass);
                if (is_correct_password($con, $id, $encode_old_pass)) {
                    // mã hóa pass mới và update pass
                    $decrypt_pass  = md5($new_pass);
                    $change = mysqli_query($con, "update `account` set AccPassword = '$decrypt_pass' where AccountID = '$id'");
                    if ($change) {
                        // thay pass thành công sẽ out khỏi tài khoản và quay về trang login
                        echo "<script>
                        alert('Password has been successfully changed');
                        </script>";
                        session_start();
                        session_destroy();
                        header("Location: login.php");
                        exit();
                    } else {
                        header("Location: change-password.php?error=Error");
                        exit();
                    }
                } else {
                    header("Location: change-password.php?error=Incorrect Password.");
                    exit();
                }
            } else {
                header("Location: change-password.php?error=The new password and confirmation password do not match.");
                exit();
            }
        } else {
            header("Location: change-password.php?error=The new password must be different from the old password.");
            exit();
        }
    } else {
        $error = "Invalid new password. Password must include 6-32 characters with at least 1 uppercase letter and 1 symbol.";
        header("Location: change-password.php?error=$error");
        exit();
    }
} //nếu chỉ có id người dùng
elseif (isset($_SESSION['id']) && !isset($_SESSION['eot'])) {
    // check xem pass mới có valid ko
    if (is_password($new_pass)) {
        // check xem pass mới và confirm pass có khớp ko
        if (is_same_string($new_pass, $new_pass1)) {
            // mã hóa pass mới và update pass
            $decrypt_pass  = md5($new_pass);
            $change = mysqli_query($con, "update `account` set AccPassword = '$decrypt_pass' where AccountID = '$id'");
            if ($change) {
                // thay pass thành công sẽ out khỏi tài khoản và quay về trang login                
                session_start();
                session_destroy();
                echo "<script>
                alert('Password has been successfully changed');
                </script>";
                header("Location: login.php");
                exit();
            } else {
                header("Location: change-password.php?error=Error");
                exit();
            }
        } else {
            header("Location: change-password.php?error=The new password and confirmation password do not match.");
            exit();
        }
    } else {
        $error = "Invalid new password. Password must include 6-32 characters with at least 1 uppercase letter and 1 symbol.";
        header("Location: change-password.php?error=$error");
        exit();
    }
} else {
    header("Location: ../../index.php");
    exit();
}
