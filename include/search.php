<?php
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $searchCase = isset($_GET['search']);
    $pageCase = isset($_GET['page']);
    $categoryCase = isset($_GET['category']);
    switch ([$categoryCase, $searchCase, $pageCase]) {
        // ?cate&search&page
        // ?search&page
        // thay search + page = search
        case [true, true, true]:
        case [false, true, true]:
            $search = $_GET['search'];
            $page = $_GET['page'];
            $url = str_replace("$search&page=$page", "$keyword", $currentUrl);
            echo "<script>window.open('$url', '_self')</script>";
            break;
        // ?cate&search
        // thay search
        case [true, true, false]:
        case [false, true, false]:
            $search = $_GET['search'];
            $url = str_replace("search=$search", "search=$keyword", $currentUrl);
            echo "<script>window.open('$url', '_self')</script>";
            break;
        // ?cate&page
        // ?page=
        // thay page = search
        case [true, false, true]:
        case [false, false, true]:
            $page = $_GET['page'];
            $url = str_replace("page=$page", "search=$keyword", $currentUrl);
            echo "<script>window.open('$url', '_self')</script>";
            break;
        // ?cate
        // thêm &search
        case [true, false, false]:
            echo "<script>window.open('$currentUrl&search=$keyword', '_self')</script>";
            break;
        // ko có gì
        // thêm ?search
        case [false, false, false]:
            echo "<script>window.open('$currentUrl?search=$keyword', '_self')</script>";
            break;
        default:
            echo "Error";
    }
}
?>