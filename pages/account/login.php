<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('../../database/dbcon.php');
    require('../../library/function.php');
    //initialise variable
    $eot = $_POST['eot'];
    $pass =  md5($_POST['password']);

    if (is_user_login($con, $eot, $pass)) {
        $condition = "WHERE AccEmail = '$eot' OR AccPhoneNo = '$eot'";
        $row = getResult($con, '*', 'Account', 'ORDER BY AccountID', $condition, 'row');
        $_SESSION['id'] = $row['AccountID'];
        $role = $row['RoleID'];
        $_SESSION['role'] = $role;
        $_SESSION['eot'] = $eot;
        header('location:../../index.php');
        exit();
    } else {
        header("Location: login.php?error=Login failed. Please check your email(phone number) and password.");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/account.css?v=<?php echo time(); ?>">
    <script src="../../public/js/script.js"></script>
</head>

<body>
    <section>
        <div class="img">
            <img src="../../public/images/account/login.jpg">
        </div>
        <div class="content">
            <div class="form">
                <h2>Log In</h2>
                <form action="login.php" method="post">
                    <div class="input">
                        <span>Email</span>
                        <input type="text" name="eot" placeholder="Enter your email or phone number" class="pass" required>
                    </div>
                    <div class="input" style="margin-bottom: 10px;">
                        <span>Password</span>
                        <input type="password" id="pass" name="password" placeholder="Enter your password" class="pass" required>
                    </div>
                    <p><input type="checkbox" onclick="showPass()">Show Password</p>
                    <!-- get error -->
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <div class="input">
                        <input type="submit" value="Log In">
                    </div>
                    <div class="input">
                        <p><span style="color: #EC94AF;">Donut</span> remember your password? <a href="forget-password.php">Get it back</a></p>
                    </div>
                    <div class="input">
                        <p><span style="color: #EC94AF;">Donut</span> have an account?
                            <a href="register.php">Register Now</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>