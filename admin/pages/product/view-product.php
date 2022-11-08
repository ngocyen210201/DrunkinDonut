<?php
session_start();
if (isset($_SESSION['id'])) {
    include('../../../database/dbcon.php');
    require('../../../library/function.php');
    $pid = $_GET['pid'];
    $query = "SELECT c.CategoryName, p.*
            FROM categories c INNER JOIN product p ON c.CategoryID = p.CategoryID
            WHERE ProductID = '$pid'";
    $row = getResultByQuery($con, $query, 'row');
    $pic = "../../../public/images/products/" . $row['ThumbnailPic'];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $row['ProductName'] ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="/DrunkinDonut/admin/public/css/style.css?v=<?php echo time(); ?>">
        <script src="/DrunkinDonut/admin/public/js/script.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    </head>

    <body>
        <?php include '../../include/header.php'; ?>
        <div class="main">
            <?php include '../../include/toggle.php'; ?>
            <div class="button-section">
                <h1 class="product-title"><?php echo $row['ProductName']; ?></h1>
                <?php if ($role == 3) { ?>
                    <div>
                        <a href="edit-product.php?pid=<?php echo $pid ?>">
                            <button type="button" class="button">
                                <i class="fa fa-pencil"></i> Edit Product
                            </button>
                        </a>
                        <a href="view-product.php?action=delete&pid=<?php echo $pid ?>">
                            <button type="submit" class="button" onclick='return onDelete()'>
                                <i class="fa fa-trash-o"></i> Delete Product
                            </button>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="card-wrapper">
                <div class="card1">
                    <div class="product-imgs">
                        <img src="<?php echo $pic ?>" width="100">
                    </div>
                    <!-- card right -->
                    <div class="product-content">
                        <div class="product-info">
                            <p><b>Category ID:</b> <?php echo $row["CategoryID"]; ?></p>
                            <p><b>Category: </b><?php echo $row["CategoryName"]; ?></p>
                            <p><b>Price: </b><?php echo number_format($row["Price"]); ?></p>
                            <p><b>Quantity:</b> <?php echo $row["ProductQuantity"]; ?></p>
                            <p><b>Discount: </b><?php echo $row["Discount"]; ?>%</p>
                        </div>
                        <div class="product-detail">
                            <p>
                                <b>Description:</b><br>
                                <?php
                                //show description and include line break for newline that stored in sql
                                echo nl2br($row["Description"]);
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            // Delete Product by icon
            if (isset($_GET['action'])) {
                //delete img from folder first
                unlink($pic);
                $delete_product = mysqli_query($con, "DELETE FROM product WHERE ProductID = '$pid' ");
                if ($delete_product) {
                    echo "<script> alert('Deleted Successfully!!')</script>";
                    echo "<script>window.open('manage-product.php', '_self')</script>";
                }
            }
            ?>
    </body>

    </html>
<?php } else {
    echo "<script>window.open('/DrunkinDonut/index.php', '_self')</script>";
    exit();
}
?>