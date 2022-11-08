<?php
session_start();
require('../../sendmail-phpmailer/send-mail.php');
include('../../database/dbcon.php');
require('../../library/function.php');

if (isset($_POST['email'])) {
    //initialise variable
    $otp = createOTP();
    $email = $_POST['email'];

    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;
    if (is_existed($con, $email)) {
        sendMail($email, $otp);
    } else {
        header("Location: forget-password.php?error=Incorrect Email.");
        exit();
    }
} 
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Confirmation</title>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/account.css?v=<?php echo time(); ?>">
    <script src="../../public/js/script.js"></script>
</head>

<body>
    <section>
        <div class="img">
            <img src="../../public/images/account/otp.jpg">
        </div>
        <div class="content">
            <div class="form">
                <h2>OTP Confirmation</h2>
                <form action="send-new.php" method="post">
                    <div class="input">
                        <span>OTP</span>
                        <input type="text" name="otp" placeholder="Enter your OTP" class="form-control" required>
                    </div>
                    <!-- get error -->
                    <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <!-- get success -->
                    <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php } ?>
                    <div class="input">
                        <input type="submit" value="Confirm">
                    </div>
                </form>
                <form action="send-new.php" method="post">
                    <div class="input">
                        <input type="submit" value="Send Another OTP">
                        <p><a href="forget-password.php">Return</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>