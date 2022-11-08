<?php
session_start();
if (isset($_SESSION['id'])) {
    include('../database/dbcon.php');
    require('../library/function.php');
?>

    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Management</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="public/css/style.css?v=<?php echo time(); ?>">
        <script src="public/js/script.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    </head>

    <body>
        <?php include 'include/header.php'; ?>
        <div class="main" style="height: 100%;">
            <?php include 'include/toggle.php'; ?>
            <div class="cardHeader">
                <h2>Dashboard</h2>
            </div>
            <div class="cardBox" <?php if ($role == 3) {
                                        echo "style = 'grid-template-columns: repeat(3, 1fr)!important;'";
                                    } ?>>
                <?php if ($role == 3) { ?>
                    <a href="pages/account/manage-account.php">
                        <div class="card">
                            <div>
                                <div class="numbers">
                                    <?php
                                    $account = getResultByQuery($con, "SELECT * FROM account", "count");
                                    echo $account;
                                    ?>
                                </div>
                                <div class="cardName">Account(s)</div>
                            </div>
                            <div class="iconBx">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                <?php } ?>

                <a href="pages/product/manage-product.php">
                    <div class="card">
                        <div>
                            <div class="numbers">
                                <?php
                                $product = getResultByQuery($con, "SELECT * FROM product", "count");
                                echo $product;
                                ?>
                            </div>
                            <div class="cardName">Product(s)</div>
                        </div>
                        <div class="iconBx">
                            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>
                <a href="pages/order/manage-order.php">
                    <div class="card">
                        <div>
                            <div class="numbers">
                                <?php
                                $order = getResultByQuery($con, "SELECT * FROM `order`", "count");
                                echo $order;
                                ?>
                            </div>
                            <div class="cardName">Order(s)</div>
                        </div>
                        <div class="iconBx">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="cardHeader">
                <h2>Order's Status</h2>
            </div>
            <div class="cardBox2">
                <?php
                $status = array();
                $status = ['unconfirmed', 'preparing', 'shipping', 'completed', 'cancelled'];
                $icons = array();
                $icons = ['fa-square-o', 'fa-hourglass-half', 'fa-flip-horizontal', 'fa-check-square', 'fa-ban'];
                for ($i = 0; $i < count($status); $i++) { ?>
                    <a href="pages/order/manage-order.php?sort=cod">
                        <div class="card2">
                            <div>
                                <div class="numbers">
                                    <?php
                                    $orderStatus = getResultByQuery($con, "SELECT * FROM `order` WHERE OrderStatus = '$status[$i]'", "count");
                                    echo $orderStatus;
                                    ?>
                                </div>
                                <div class="cardName">
                                    <?php
                                    echo ucfirst($status[$i]);
                                    ?>
                                </div>
                            </div>
                            <div class="iconBx">
                                <i class="fa <?php echo $icons[$i] ?>" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </body>

    </html>
<?php
} else {
    header("Location: ../index.php");
    exit();
}
?>