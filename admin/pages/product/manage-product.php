<?php
session_start();
if (isset($_SESSION['id'])) {
    include('../../../database/dbcon.php');
    require('../../../library/function.php');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Product(s)</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="/DrunkinDonut/admin/public/css/style.css?v=<?php echo time(); ?>">
        <script src="/DrunkinDonut/admin/public/js/script.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    </head>

    <body>
        <?php include '../../include/header.php'; ?>
        <div class="main">
            <?php
            include '../../include/toggle.php';
            include '../../include/search.php';
            $i = 0;
            // tổng số account trả về
            $numStart = 0;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $numStart = 5 * ($page - 1);
            }
            $condition = "";
            if (isset($_GET['search'])) {
                $key = $_GET['search'];
                $condition = "WHERE ProductName LIKE '%$key%' OR CategoryName LIKE '%$key%'";
            }
            $pageItem = 5;
            $query = "SELECT ProductID, c.CategoryName, ProductName, ThumbnailPic, Price, ProductQuantity 
                        FROM `Product` p INNER JOIN `Categories` c ON p.CategoryID = c.CategoryID $condition
                        ORDER BY ProductID LIMIT $pageItem OFFSET $numStart";
            $getAll = "SELECT ProductID, c.CategoryName, ProductName, ThumbnailPic, Price, ProductQuantity 
                        FROM `Product` p INNER JOIN `Categories` c ON p.CategoryID = c.CategoryID $condition";
            $totalItem = getResultByQuery($con, $getAll, 'count');
            $getProduct = mysqli_query($con, $query);
            if ($totalItem == 0) { ?>
                <div class="message">No Result Found</div>
            <?php } else { ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="button-section">
                        <h1>Product(s)</h1>
                        <div>
                            <?php
                            if ($role == 3) { ?>
                                <a href="add-product.php">
                                    <button type="button" class="button">
                                        <i class="fa fa-plus"></i> Add Product
                                    </button>
                                </a>

                                <button type="submit" class="button" name="delete_all" onclick='return onDelete()'>
                                    <i class="fa fa-trash-o"></i> Delete Product
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                    <table id="account">
                        <thead>
                            <tr>
                                <?php if ($role == 3) { ?>
                                    <th style="width:5%;"><input type="checkbox" id="checkAll" value="" onclick="toggle(this)" /></th>
                                <?php } ?>
                                <th>ID </th>
                                <th>Category Name</th>
                                <th>Product Name</th>
                                <th>Thumbnail Picture</th>
                                <th>Price</th>
                                <th>Product Quantity</th>
                                <th>Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($getProduct)) { ?>
                                <tr>
                                    <?php if ($role == 3) { ?>
                                        <td><input type="checkbox" class="checkBox" name="choose_all[]" value="<?php echo $row['ProductID'] ?>" /></td>
                                    <?php } ?>
                                    <td><?php echo $row['ProductID'] ?></td>
                                    <td><?php echo $row['CategoryName'] ?></td>
                                    <td><?php echo $row['ProductName'] ?></td>
                                    <td><img src="<?php echo "../../../public/images/products/" . $row['ThumbnailPic'] ?>" width="100"></td>
                                    <td><?php echo number_format($row['Price']); ?></td>
                                    <td><?php echo $row['ProductQuantity'] ?></td>
                                    <td>
                                        <a href="view-product.php?pid=<?php echo $row['ProductID'] ?>">
                                            <button type="button" class="fa fa-eye"></button>
                                        </a>
                                        <?php if ($role == 3) { ?>
                                            <a href="edit-product.php?pid=<?php echo $row['ProductID'] ?>">
                                                <button type="button" class="fa fa-pencil-square-o"></button>
                                            </a>
                                            <a href="manage-product.php?delete-id=<?php echo $row['ProductID'] ?>">
                                                <button type="button" id="delete" class="fa fa-trash-o" onclick='return checkdelete()'></button>
                                            </a>
                                        <?php } else { ?>
                                            <button type="button" id="edit<?php echo $i ?>" class="fa fa-pencil-square-o" onclick="openModal(this.id)"></button>
                                            <!-- Modal content -->
                                            <form action="manage-product.php?action=edit&id=<?php echo $row['ProductID']; ?>" method="POST" role="form" enctype="multipart/form-data">
                                                <div id="myModal-edit<?php echo $i ?>" class="modal">
                                                    <div class="modal-content" style="width: 30%;">
                                                        <div class="modal-head">
                                                            <h1>Product #<?php echo $row['ProductID'] ?> </h1>
                                                            <span class="close" id="close-edit<?php echo $i ?>">&times;</span>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="details">
                                                                <b>Product Name:</b> <?php echo $row['ProductName'] ?> <br>
                                                                <b>Category:</b> <?php echo $row['CategoryName'] ?> <br>
                                                                <b>Price:</b> <?php echo $row['Price'] ?><br>
                                                                <b>Quantity: </b>
                                                                <input type="number" id="quantity<?php echo $i ?>" name="quantity" value="<?php echo $row["ProductQuantity"]; ?>" style="width: 30%; margin-bottom: 20px;" required>
                                                            </div>
                                                            <div class="option">
                                                                <button type="button" id="edit-product-<?php echo $row['ProductID'] ?>" onclick="passIdProduct(this.id)">Save Change</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </form>
            <?php } ?>
            <?php include '../../include/pagination.php'; ?>
        </div>
    </body>

    </html>
<?php
    // delete single item
    if (isset($_GET['delete-id'])) {
        $pid = $_GET['delete-id'];
        $pic = getResult($con, "ThumbnailPic", "Product", "", "WHERE ProductID = '$pid'", "row");
        unlink("../../../public/images/products/" . $pic['ThumbnailPic']);
        $delete_product = mysqli_query($con, "DELETE FROM product WHERE ProductID =  '$pid'");
        if ($delete_product) {
            echo "<script> alert('Deleted Successfully!!')</script>";
            echo "<script>window.open('manage-product.php', '_self')</script>";
        } else {
            echo "<script>alert('Error: mysqli_error($con)!')</script>";
        }
    }

    // delete multiple items
    if (isset($_POST['choose_all'])) {
        $remove = $_POST['choose_all'];
        foreach ($remove as $item) {
            $pic = getResult($con, "ThumbnailPic", "Product", "", "WHERE ProductID = '$item'", "row");
            unlink("../../../public/images/products/" . $pic['ThumbnailPic']);
            $delete_product = mysqli_query($con, "DELETE FROM product WHERE ProductID =  '$item'");
            if ($delete_product) {
                echo "<script> alert('Deleted Successfully!!')</script>";
                echo "<script>window.open('manage-product.php', '_self')</script>";
            } else {
                echo "<script>alert('Error: mysqli_error($con)!')</script>";
            }
        }
    }

    // update quantity
    if (isset($_GET['edit-product'])) {
        $editID = $_GET['edit-product'];
        $newQuantity = $_GET['quantity'];
        $floatQuantity = (float)$newQuantity;
        if ($floatQuantity < 0 || fmod($floatQuantity, 1) != 0 || $floatQuantity > 4294967295 || $newQuantity == "") {
            echo "<script> alert('Invalid Quantity!!')</script>";
        } else {
            updateItem($con, "Product", "ProductQuantity = $newQuantity", "ProductID = $editID");
        }
        echo "<script>window.location.href = '/DrunkinDonut/admin/pages/product/manage-product.php'</script>";
    }
} else {
    header("Location: /DrunkinDonut/index.php");
    exit();
}
?>