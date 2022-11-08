<?php
// lấy url hiện tại
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (!str_contains($currentUrl, "product-list")) {
    $currentUrl = "/DrunkinDonut/pages/product/product-list.php";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/DrunkinDonut/public/fonts/fontawesome/fontawesome-free-6.1.2-web/css/all.min.css">
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossrigin="" anonymous></script>
    <link rel="stylesheet" href="/DrunkinDonut/public/css/style.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/DrunkinDonut/public/js/script.js"></script>
</head>

<body>

    <header>

        <a href="/DrunkinDonut/index.php">
            <img class="logo" src="/DrunkinDonut/public/images/Logo.png" alt="logo">
        </a>
        <a href="/DrunkinDonut/index.php" class="web_name">
            <span class="full_name">runkin Donut</span>
            <span class="alias">runkin onut</span>
        </a>

        <form action="<?php echo $currentUrl ?>" class="search-form" method="post">
            <input type="search" name="keyword" placeholder="Search for Donut" id="search-box" <?php if (isset($_GET['search'])) {
                                                                                                    $search = $_GET['search'];
                                                                                                    echo "value='$search'";
                                                                                                } ?>required>
            <button type="submit" class="fa fa-search"></button>
        </form>

        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fa-solid fa-bars"></label>


        <nav class="navbar">
            <ul>
                <li> <a href="/DrunkinDonut/index.php">Home</a></li>
                <li> <a href="/DrunkinDonut/pages/product/product-list.php">Product</a></li>
                <li> <a href="/DrunkinDonut/pages/about_us.php">About Us</a></li>
                <li><a class="cta" href="#contact">Contact</a></li>
            </ul>
        </nav>
        <div class="icons">
            <div class="dropdown"><a class="fa-solid fa-user "></a>
                <div class="dropdown-content">
                    <?php if (!isset($_SESSION['id'])) {  ?>
                        <a href="/DrunkinDonut/pages/my-order.php">My Orders</a>
                        <a href="/DrunkinDonut/pages/account/login.php">Log In</a>
                    <?php } elseif ($_SESSION['role'] == 1) { ?>
                        <a href="/DrunkinDonut/user_orders/my-order.php">My Orders</a>
                        <a href="/DrunkinDonut/pages/account/change-password.php">My Account</a>
                        <a href="/DrunkinDonut/pages/account/change-password.php">Change Password</a>
                        <a href="/DrunkinDonut/pages/account/logout.php">Log Out</a>
                    <?php } elseif ($_SESSION['role'] != 1) { ?>
                        <a href="/DrunkinDonut/admin/index.php">Management</a>
                        <a href="/DrunkinDonut/pages/account/logout.php">Log Out</a>
                    <?php } ?>
                </div>
            </div>
            <a href="./pages/view_cart.php" class="fa-solid fa-basket-shopping">
            </a>
        </div>
    </header>
</body>

</html>