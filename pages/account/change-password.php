<?php
session_start();
if (isset($_SESSION['id'])) {
?>
    <!DOCTYPE html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Change Password</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../public/css/account.css?v=<?php echo time(); ?>">
        <script src="/DrunkinDonut/user/public/js/script.js" defer></script>
    </head>

    <body>
        <section>
            <div class="img">
                <img src="../../public/images/account/change.jpg">
            </div>
            <div class="content">
                <div class="form">
                    <h2>Change Password</h2>
                    <form action="pass-check.php" method="post">
                        <?php if (isset($_SESSION['eot'])) { ?>
                            <div class="input">
                                <span>Old Password</span>
                                <input type="password" id="pass" name="old_pass" placeholder="Enter Old Password" class="pass" required>

                            </div>
                        <?php } ?>

                        <div class="input">
                            <span>New Password</span>
                            <input type="password" id="new_pass" name="new_pass" placeholder="Enter New Password" class="pass" required>

                        </div>
                        <div class="input" style="margin-bottom: 10px;">
                            <span>Confirmation Password</span>
                            <input type="password" id="new_pass1" name="new_pass1" placeholder="Enter Confirmation Password" class="pass" required>

                        </div>
                        <!-- show password -->
                        <input type="checkbox" onclick="showPass()" style="margin-bottom: 20px;">Show Password

                        <!-- get error -->
                        <?php if (isset($_GET['error'])) { ?>
                            <p class="error"><?php echo $_GET['error']; ?></p>
                        <?php } ?>
                        <div class="input">
                            <input type="submit" value="Change Password">
                            <p><a onclick="history.back()">Return</a></p>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </body>

    </html>
<?php
} else {
    header("Location: ../../index.php");
    exit();
}
?>