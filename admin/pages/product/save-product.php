<?php
session_start();
include('../../../database/dbcon.php');
require('../../../library/function.php');

$cid = $_POST['cateList'];
$pname = $_POST['pname'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$desc = $_POST['desc'];
// edit product
if ($_GET['action'] == 'edit') {
    $pid = $_POST['pid'];
    $query = "SELECT c.CategoryName, p.*
            FROM categories c INNER JOIN product p ON c.CategoryID = p.CategoryID
            WHERE ProductID = '$pid'";
    $row = getResultByQuery($con, $query, 'row');
    $num = getResultByQuery($con, $query, 'count');
    //create img path
    $pic =  "../../../public/images/products/" . $row['ThumbnailPic'];
    $discount = $_POST['discount'];
    if ($discount == '') {
        $discount = 0;
    }
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {
            gc_collect_cycles();
            unlink($pic);
            $exp = explode('.', $image_name1);
            $ext = end($exp);
            $strlow = strtolower($ext);
            if ($strlow == 'jpg' || $strlow == 'png' || $strlow == 'jpeg') {
                $src = $_FILES['image']['tmp_name'];
                $dst = "../../../public/images/products/" . $image_name;
                $upload = move_uploaded_file($src, $dst);
                if ($upload == false) {
                    echo "<script> window.location.href = 'edit-product.php?pid=$pid&error=Upload Failled';</script>";
                    exit();
                }
            } else {
                echo "<script> window.location.href = 'edit-product.php?pid=$pid&error=Invalid photo type.';</script>";
                exit();
            }
        } else {
            $image_name = $row['ThumbnailPic'];
        }
    }
    if ($image_name == "") {
        echo "<script> window.location.href = 'edit-product.php?pid=$pid&error=Thumbnail picture cannot be empty.';</script>";
        exit();
    } elseif (strlen($pname) > 255) {
        echo "<script> window.location.href = 'edit-product.php?pid=$pid&error=The product name is too long.';</script>";
        exit();
    }  //check description content length
    elseif (strlen($desc) > 3000) {
        echo "<script> window.location.href = 'edit-product.php?pid=$pid&error=The description content is too long.';</script>";
        exit();
    } elseif (!is_positive($price) || !is_positive($quantity) || !is_positive($discount)) {
        echo "<script> window.location.href = 'edit-product.php?pid=$pid&error=The product price, quantity or discount must be a positive number.';</script>";
        exit();
    } else {
        //Insert into database
        $updateProduct = mysqli_query($con, "UPDATE product
                SET ProductName = '$pname', ThumbnailPic = '$image_name', 
                Price = '$price', ProductQuantity = '$price', 
                Discount = '$discount', `Description` = '$desc', CategoryID = '$cid' WHERE ProductID = '$pid'");
        if ($updateProduct) {
            echo "<script> alert('Product has been updated!');
            window.location.href = 'view-product.php?pid=$pid';</script>";
        }
    }
} //add new product
elseif ($_GET['action'] == 'add') {
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {
            $src = $_FILES['image']['tmp_name'];
            $dst = "../../../public/images/products/" . $image_name;
            //put image in the located folder
            $upload = move_uploaded_file($src, $dst);
            // Check whether image is uploaded or not
            if ($upload == false) {
                echo "<script> window.location.href = 'add-product.php?error=Upload Failled';</script>";
                exit();
            }
        }
    } else {
        $image_name = '';
    }

    if ($image_name == "") {
        echo "<script> window.location.href = 'add-product.php?error=Thumbnail picture cannot be empty.';</script>";
        exit();
    } elseif (strlen($pname) > 255) {
        echo "<script> window.location.href = 'add-product.php?error=The product name is too long.';</script>";
        exit();
    }  //check description content length
    elseif (strlen($desc) > 3000) {
        echo "<script> window.location.href = 'add-product.php?error=The description content is too long.';</script>";
        exit();
    } elseif (!is_positive($price) || !is_positive($quantity)) {
        echo "<script> window.location.href = 'add-product.php?error=The product price, quantity or discount must be a positive number.';</script>";
        exit();
    } else {
        //Insert into database
        $addProduct = mysqli_query($con, "INSERT INTO product
                (ProductName, ThumbnailPic, Price, ProductQuantity, `Description`, CategoryID) 
                VALUES ('$pname', '$image_name', '$price', '$quantity', '$desc', '$cid')");
        if ($addProduct) {
            echo "<script> alert('Product has been added!');
            window.location.href = 'manage-product.php';</script>";
        }
    }
}
