<?php
// session_start();
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li class="role-name">
                    <a href="/DrunkinDonut/admin/index.php" class="role-name-a">
                        <span class="icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                        <?php if ($role == 3) { ?>
                            <h2>Admin</h2>
                        <?php } else { ?>
                            <h2>Employee</h2>
                        <?php } ?>

                    </a>
                </li>
                <li>
                    <a href="/DrunkinDonut/index.php">
                        <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
                        <span class="title">Homepage</span>
                    </a>
                </li>
                <li>
                    <a href="/DrunkinDonut/admin/index.php">
                        <span class="icon"><i class="fa fa-th-list" aria-hidden="true"></i></span>
                        <span class="title">Management</span>
                    </a>
                </li>
                <?php if ($role == 3) { ?>
                    <li>
                        <a href="/DrunkinDonut/admin/pages/account/manage-account.php">
                            <span class="icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                            <span class="title">Account(s)</span>
                        </a>
                    </li>
                <?php } ?>
                <li>
                    <a href="/DrunkinDonut/admin/pages/product/manage-product.php">
                        <span class="icon"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        </span>
                        <span class="title">Product(s)</span>
                    </a>
                </li>
                <li>
                    <a href="../admin_manage_orders/manage_orders.php?sort=all">
                        <span class="icon"><i class="fa fa-archive" aria-hidden="true"></i>
                        </span>
                        <span class="title">Order(s)</span>
                    </a>
                </li>
                <li>
                    <a href="/DrunkinDonut/pages/account/change-password.php">
                        <span class="icon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <span class="title">Change Password</span>
                    </a>
                </li>
                <li>
                    <a href="/DrunkinDonut/pages/account/logout.php">
                        <span class="icon"><i class="fa fa-sign-out" aria-hidden="true"></i></span>
                        <span class="title">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>