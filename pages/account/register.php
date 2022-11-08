<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../../public/css/account.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../../../public/fonts/fontawesome/fontawesome-free-6.1.2-web/css/all.min.css">
  <script src="../../public/js/script.js"></script>
</head>

<body>
  <section>
    <div class="img">
      <img src="../../public/images/account/Register.jpg">
    </div>
    <div class="content">
      <div class="form">
        <h2>Register</h2>
        <form action="registration.php" method="post">
          <div class="input">
            <span>Username</span>
            <input type="text" name="user" placeholder="Nhập Tên Đăng Ký" class="form-control" required>
          </div>
          <div class="input">
            <span>Password</span>
            <input type="password" id="pass" name="password" placeholder="Nhập mật khẩu" class="pass" required>
          </div>
          <!-- show the password -->
          <input type="checkbox" onclick="showPass()">Show Password
          <div class="input">
            <span>Email</span>
            <input type="email" name="email" placeholder="Enter your email" class="form-control" required>
          </div>
          <div class="input">
            <span>Phone Number</span>
            <input type="tel" name="telephone" placeholder="Enter your phone number" class="form-control" required>
          </div>
          <!-- display error or success message -->
          <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
          <?php } ?>
          <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>
          <div class="input">
            <input type="submit" value="Create Account">
          </div>
          <div class="input">
            <p><a onclick="history.back()"><i class="fa-solid fa-turn-down-left"></i>Return</a></p>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>

</html>