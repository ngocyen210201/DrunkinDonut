<?php
// lấy url hiện tại
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $searchCase = isset($_GET['search']);
    $pageCase = isset($_GET['page']);

    switch ([$searchCase, $pageCase]) {
        case [true, false]:
            $search = $_GET['search'];
            $url = str_replace("$search", "$keyword", $currentUrl);
            echo "<script>window.open('$url', '_self')</script>";
            break;
        case [true, true]:
            $search = $_GET['search'];
            $page = $_GET['page'];
            $url = str_replace("$search&page=$page", "$keyword", $currentUrl);
            echo "<script>window.open('$url', '_self')</script>";
            break;
        case [false, true]:
            $page = $_GET['page'];
            $url = str_replace("?page=$page", "?search=$keyword", $currentUrl);
            echo "<script>window.open('$url', '_self')</script>";
            break;
        case [false, false]:
            echo "<script>window.open('$currentUrl?search=$keyword', '_self')</script>";
            break;
        default:
            echo "Error";
    }
}
?>
<div class="cardHeader">
    <form action="<?php echo $currentUrl ?>" class="search-form" method="post">
        <input type="search" name="keyword" placeholder="Search..." id="search-box" 
        <?php if (isset($_GET['search'])) {
            $search = $_GET['search'];
            echo "value='$search'";
        } ?>required>
        <button type="submit" class="fa fa-search"></button>
    </form>
</div>