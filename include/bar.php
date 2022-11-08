<?php
$category = '';
$class = "class = 'active'";
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    switch ($category) {
        case 'all':
            $condition = "";
            break;
        case 'basic':
            $condition = "WHERE CategoryName = 'Basic'";
            break;
        case 'box-set':
            $condition = "WHERE CategoryName = 'Box Set'";
            break;
        case 'filled':
            $condition = "WHERE CategoryName = 'Filled'";
            break;
        case 'special':
            $condition = "WHERE CategoryName = 'Special'";
            break;
        default:
            # code...
            break;
    }
}
?>


<div class="category">
    <a href="product-list.php?category=all">
        <img src="/DrunkinDonut/public/images/category/All.png">
        <p <?php
            if ($category == '' || $category == 'all') {
                echo $class;
            }
            ?>>All</p>
    </a>
    <a href="product-list.php?category=basic">
        <img src="/DrunkinDonut/public/images/category/Basic.png">
        <p <?php
            if ($category == 'basic') {
                echo $class;
            }
            ?>>Basic</p>
    </a>
    <a href="product-list.php?category=box-set">
        <img src="/DrunkinDonut/public/images/category/Box Set.jpg">
        <p <?php
            if ($category == 'box-set') {
                echo $class;
            }
            ?>>Box Set</p>
    </a>
    <a href="product-list.php?category=filled">
        <img src="/DrunkinDonut/public/images/category/Filled.png">
        <p <?php
            if ($category == 'filled') {
                echo $class;
            }
            ?>>Filled</p>
    </a>
    <a href="product-list.php?category=special">
        <img src="/DrunkinDonut/public/images/category/Special.png">
        <p <?php
            if ($category == 'special') {
                echo $class;
            }
            ?>>Special</p>
    </a>
</div>