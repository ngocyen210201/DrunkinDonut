<?php
session_start();
include('../../database/dbcon.php');
require('../../library/function.php');
//initialise variable
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else{
    $id = $_SESSION['anonID'];
}
$pid = $_POST['pid'];
$quantity = $_POST['quantity'];

// tìm cart id
$row = getResult($con, "*", "Cart", "", "WHERE AccountID = $id", "row");
$cartID = $row['CartID'];

$row1 = getResult($con, "*", "Product", "", "WHERE ProductID = '$pid'", "row");
$stock = $row1['ProductQuantity'];

// 
$row2 = getResult($con, "*", "Product_Cart", "", "WHERE CartID = '$cartID' AND ProductID = '$pid'", "row");
$num = getResult($con, "*", "Product_Cart", "", "WHERE CartID = '$cartID' AND ProductID = '$pid'", "count");

if ($quantity > $stock) {
    echo "<script>
    window.open('view-product.php?pid=$pid&error=The number of products is bigger than in-stock products.', '_self')
    </script>";
} elseif ($quantity == 0) {
    echo "<script>
    window.open('view-product.php?pid=$pid&error=Invalid product quantity.', '_self')
    </script>";
} elseif ($num == 1) {
    $cart_quantity = $row2['Quantity'];
    $total_quantity = $cart_quantity + $quantity;
    $allow = $stock - $cart_quantity;
    if ($cart_quantity == $stock) {
        echo "<script>
        window.open('view-product.php?pid=$pid&error=The number of products is bigger than in-stock products.', '_self')
        </script>";
    } elseif ($total_quantity > $stock) {
        echo "<script>
        window.open('view-product.php?pid=$pid&error=There are already $cart_quantity of these in your cart, you can only add $allow more.', '_self')
        </script>";
    } elseif ($total_quantity <= $stock) {
        mysqli_query($con, "UPDATE Product_Cart SET Quantity = (Quantity+'$quantity') WHERE CartID = '$cartID' AND ProductID = '$pid'");
        echo "<script>window.open('view-product.php?pid=$pid&success=Added Successfully!!', '_self')</script>";
    }
} elseif ($num == 0) {
    mysqli_query($con, "INSERT INTO Product_Cart(`ProductID`,`CartID`,`Quantity`)  VALUES('$pid', '$cartID', '$quantity')");
    echo "<script>window.open('view-product.php?pid=$pid&success=Added Successfully!!', '_self')</script>";
}
