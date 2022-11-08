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
    $numCate = getResult($con, 'CategoryName', 'Categories', 'ORDER BY CategoryName', '', 'count');
    $getCate = mysqli_query($con, "SELECT * FROM `Categories` ORDER BY CategoryName");
    $j = 0;
    while ($rowCate = mysqli_fetch_array($getCate)) {
        $cateID[] = $rowCate['CategoryID'];
        $cateName[] = $rowCate['CategoryName'];
        $j++;
    }
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
                <h1 class="product-title">Edit Product</h1>
                <div>
                    <button type="submit" class="button" form="my-form" id="save">
                        <i class="fa fa-floppy-o"> Save</i>
                    </button>
                    <a href="view-product.php?pid=<?php echo $pid ?>">
                        <button type="button" class="button button4">
                            <i class="fa fa-ban"> Cancel</i>
                        </button>
                    </a>
                </div>
            </div>
            <div class="card-wrapper">
                <div class="card">
                    <form action="save-product.php?action=edit" id="my-form" method="post" enctype="multipart/form-data">
                        <div class="product-imgs">
                            <div class="img-display">
                                <img src="<?php echo $pic ?>" width="100">
                                <div class="img0" id="choose">
                                    <label for="image"><span style="color:red; display:inline;">* </span>Change picture</label>
                                    <input type="file" name="image" id="image" accept="image/png, image/jpeg, image/jpg">
                                </div>
                                <div id="preview">
                                    <i class="fa fa-times" onclick="delImage()" id="close" style="display: none;"></i>
                                    <div id="preview-img"></div>
                                </div>
                            </div>
                        </div>

                        <!-- card right -->
                        <div class="product-content">
                            <?php //display error message
                            if (isset($_GET['error'])) { ?>
                                <div id="error" style="font-size: 20px">
                                    <p class="error"><?php echo $_GET['error']; ?></p>
                                </div>
                            <?php } elseif (isset($_GET['success'])) { ?>
                                <p class="success"><?php echo $_GET['success']; ?></p>
                            <?php } ?>
                            <div class="product-info">
                                <input type="text" name="pid" value="<?php echo $row["ProductID"]; ?>" style="display: none">
                                <p>
                                    <span style="color:red; display:inline;">* </span>
                                    <b>Category: </b>
                                    <select id="cate-list-<?php echo $row['ProductID'] ?>" name="cateList">
                                        <option value="<?php echo  $row['CategoryID'] ?>"><?php echo  $row['CategoryName']; ?></option>
                                        <?php
                                        for ($index = 0; $index < $numCate; $index++) {
                                            if ($cateName[$index] != $row['CategoryName']) { ?>
                                                <option value="<?php echo $cateID[$index] ?>"><?php echo $cateName[$index]; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </p>
                                <p>
                                    <span style="color:red; display:inline;">* </span>
                                    <b>Product Name: </b>
                                    <input type="text" name="pname" value="<?php echo $row["ProductName"]; ?>" required>
                                </p>
                                <p>
                                    <span style="color:red; display:inline;">* </span>
                                    <b>Price: </b>
                                    <input type="number" name="price" value="<?php echo $row["Price"]; ?>" required>
                                </p>
                                <p>
                                    <span style="color:red; display:inline;">* </span>
                                    <b>Quantity: </b>
                                    <input type="number" name="quantity" value="<?php echo $row["ProductQuantity"]; ?>" required>
                                </p>
                                <p>
                                    <b>Discount: </b>
                                    <input type="number" name="discount" value="<?php echo $row["Discount"]; ?>">
                                </p>
                            </div>

                            <div class="product-detail">
                                <p>
                                    <b>Description:</b>
                                    <textarea name="desc">
                                        <?php echo $row["Description"]; ?>
                                    </textarea>
                                </p>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <script>
            displayPreview();
        </script>
    </body>

    </html>

<?php } else {
    echo "<script>window.open('/DrunkinDonut/index.php', '_self')</script>";
    exit();
}
?>