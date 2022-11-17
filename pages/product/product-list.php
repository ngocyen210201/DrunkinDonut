<?php
session_start();
include('../../database/dbcon.php');
require('../../library/function.php');
include('../../include/header.php');
include('../../include/search.php');
$condition = "";
$searchCondition = "";
$sort = "";
if (isset($_POST['sort'])) {
    $url = $_SESSION['url'];
    $sort = $_POST['sort'];
    // nếu url chứa sort sẵn
    if (str_contains($url, 'sort')) {
        if (str_contains($url, '?sort')) {
            $url = explode("?sort", $url);
        } else {
            $url = explode("&sort", $url);
        }
        $newUrl = $url[0];
        if (str_contains($newUrl, '?')) {
            echo "<script>window.open('$newUrl&sort=$sort', '_self')</script>";
        } else {
            echo "<script>window.open('$newUrl?sort=$sort', '_self')</script>";
        }
    } else {
        if (str_contains($url, '?')) {
            echo "<script>window.open('$url&sort=$sort', '_self')</script>";
        } else {
            echo "<script>window.open('$url?sort=$sort', '_self')</script>";
        }
    }
    unset($_SESSION['url']);
    exit();
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../public/css/style.css?v=<?php echo time(); ?>">
    <script src="../../public/js/script.js"></script>
</head>

<body id="pro-page">
    <?php include('../../include/bar.php');  ?>
    <div class="main">
        <form action="product-list.php" method="post">
            <div class="row">
                <div class="col1">
                    <div class="sort-box">
                        <select name="sort" id="sort" class="form-control" onchange="this.form.submit();">
                            <!-- select sorting option and remember the option when the page is reload -->
                            <option value="new" <?php if (isset($_GET['sort']) && $_GET['sort'] == "new") {
                                                    echo "selected";
                                                    $sort = "CreateDate DESC";
                                                } ?>>Newest
                            </option>
                            <option value="low" <?php if (isset($_GET['sort']) && $_GET['sort'] == "low") {
                                                    echo "selected";
                                                    $sort = "Price ASC";
                                                } ?>>Price: Low to High
                            </option>
                            <option value="high" <?php if (isset($_GET['sort']) && $_GET['sort'] == "high") {
                                                        echo "selected";
                                                        $sort = "Price DESC";
                                                    } ?>>Price: High to Low
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <div class="container-p" id="1">
            <?php
            //check điều kiện để sort
            if (!isset($_GET['sort'])) {
                $sort = "CreateDate DESC";
            }
            $i = 0;
            // tổng số product trả về
            $numStart = 0;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $numStart = 12 * ($page - 1);
            }

            if (isset($_GET['search'])) {
                $key = $_GET['search'];
                $searchCondition = "WHERE ProductName LIKE '%$key%'";
                if (isset($_GET['category'])) {
                    $searchCondition = "AND ProductName LIKE '%$key%'";
                }
            }
            $pageItem = 12;
            $query = "SELECT ProductID, c.*, ProductName, ThumbnailPic, Price, ProductQuantity 
                        FROM `Product` p LEFT JOIN `Categories` c ON p.CategoryID = c.CategoryID $condition $searchCondition
                        ORDER BY $sort LIMIT $pageItem OFFSET $numStart";
            $getAll = "SELECT ProductID, c.CategoryName, ProductName, ThumbnailPic, Price, ProductQuantity 
                        FROM `Product` p INNER JOIN `Categories` c ON p.CategoryID = c.CategoryID $condition";
            $totalItem = getResultByQuery($con, $getAll, 'count');
            $getProduct = mysqli_query($con, $query);
            //retreat data from the previous query
            while ($row = mysqli_fetch_array($getProduct)) {
                $img =  "../../public/images/products/" . $row['ThumbnailPic'];
                //check if the product is still available
                if ($row["ProductQuantity"] > 0) {
            ?>
                    <div class="card-p">
                        <!-- echo the category id -->

                        <div class="img">
                            <a href="view-product.php?pid=<?php echo $row["ProductID"] ?>">
                                <img src="<?php echo $img ?>">
                            </a>
                        </div>

                        <div class="content">
                            <a href="view-product.php?pid=<?php echo $row["ProductID"] ?>">
                                <div class="productName">
                                    <h3><?php echo $row['ProductName']; ?></h3>
                                </div>
                            </a>
                            <div class="price">
                                <h2><?php echo number_format($row['Price']); ?>đ</h2>
                            </div>
                        </div>
                    </div>
                <?php
                } else { ?>
                    <div class="card-p1">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="img">
                                <img src="<?php echo $img ?>">
                                <div class="middle">
                                    <div class="text">Hết Hàng</div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="productName">
                                    <h3><?php echo $row['ProductName']; ?></h3>
                                </div>
                                <div class="price">
                                    <h2><?php echo number_format($row['Price']); ?>đ</h2>
                                </div>
                            </div>
                        </form>
                    </div>
            <?php }
                $i++;
            } ?>
        </div>
    </div>
    <?php include '../../include/pagination.php'; ?>
    <div class="view-footer" style="bottom: 0; left: 0;right: 0; position:absolute;">
        <?php include('../../include/footer.php'); ?>
    </div>
</body>

</html>