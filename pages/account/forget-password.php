<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/account.css?v=<?php echo time(); ?>">
    <script src="../../public/js/script.js"></script>
</head>

<body>
    <section>
        <div class="img">
            <img src="../../public/images/account/forget.jpg">
        </div>
        <div class="content">
            <div class="form">
                <h2>Forget Password</h2>
                <form action="otp-confirmation.php" method="post">
                    <div class="input">
                        <span>Email</span>
                        <input type="email" name="email" placeholder="Enter your email" class="form-control" required>
                    </div>
                    <!-- get error -->
                    <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <div class="input">
                        <input type="submit" value="Get OTP Code">
                        <p><a href="login.php">Return</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>