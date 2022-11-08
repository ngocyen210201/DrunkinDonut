<?php
session_start();
    include('../../database/dbcon.php');
    require('../../library/function.php');
    include('../../include/header.php');
    include('../../include/search.php');

    $pid = $_GET['pid'];
    $query = "SELECT c.CategoryName, p.*
            FROM categories c INNER JOIN product p ON c.CategoryID = p.CategoryID
            WHERE ProductID = '$pid'";
    $row = getResultByQuery($con, $query, 'row');
    $pic = "../../public/images/products/" . $row['ThumbnailPic'];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $row['ProductName'] ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="../../public/css/style.css?v=<?php echo time(); ?>">
        <script src="../../public/js/script.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    </head>

    <body style="left: 0;right: 0;">
        <div class="card-wrapper">
            <div class="card">
                <div class="product-imgs">
                    <img src="<?php echo $pic ?>" alt="<?php echo $row["ProductName"] ?>">
                </div>
                <div class="product-content">
                    <!-- product name -->
                    <h2 class="product-title">
                        <?php echo $row["ProductName"]; ?>
                    </h2>
                    <!-- product price -->
                    <div class="product-price">
                        <p id="price">
                            <?php echo number_format($row["Price"]); ?>đ
                        </p>
                    </div>

                    <!-- product quantity -->
                    <form action="add_cart.php?pid=<?php echo $pid ?>" method="post" enctype="multipart/form-data" id="myForm">
                        <input id="pid" name="pid" value="<?php echo $pid1 ?>" type="text" style="display: none;">
                        <div class="number">
                            <p class="quantity"> Quantity </p>
                            <span class="minus">-</span>

                            <!-- allow only number from 0-9 -->

                            <input type="text" name="quantity" value="1" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 13" readonly />
                            <span class="plus">+</span>

                            <p class="pnumber" id="pnumber">
                                <?php echo $row['ProductQuantity']; ?> product(s)
                            </p>
                            <?php if ($row['Description'] != "") { ?>
                                <div class="product-description">
                                    <h4>Description</h4>
                                    <p>
                                        <?php
                                        //show description and include line break for newline that stored in sql
                                        echo nl2br($row["Description"]);
                                        ?>
                                    </p>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if (isset($_GET['error'])) { ?>
                            <p class="error" id="message" style="display: block;"><?php echo $_GET['error']; ?></p>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                            <p class="success" id="message" style="display: block;"><?php echo $_GET['success']; ?></p>
                        <?php } ?>
                        <div class="purchase-info">
                            <button type="button" class="btn" id="add">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
        <?php if ($row['Description'] != "") { ?>
            <div class="view-footer" style="bottom: 0; left: 0;right: 0;">
                <?php include '../../include/footer.php'; ?>
            </div>
        <?php } elseif ($row['Description'] == "") { ?>
            <div class="view-footer1">
                <?php include '../../include/footer.php'; ?>
            </div>
        <?php } ?>
        <script>
            $(document).ready(function() {
                // trừ đi số lượng
                $('.minus').click(function() {
                    var $input = $(this).parent().find('input');
                    var count = parseInt($input.val()) - 1;
                    count = count < 1 ? 1 : count;
                    $input.val(count);
                    $input.change();
                    return false;

                });
                // cộng thêm số lượng
                $('.plus').click(function() {
                    var $input = $(this).parent().find('input');
                    $input.val(parseInt($input.val()) + 1);
                    $input.val();
                    $input.change();
                    return false;
                });
            });
        </script>
    </body>

    </html>
