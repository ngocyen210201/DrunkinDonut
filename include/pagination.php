<div class="pagination" id="pagination">
    <?php
    // số trang = tổng số item / item xuất hiện trong 1 page
    $totalPage = $totalItem / $pageItem + 1;
    for ($i = 1; $i < $totalPage; $i++) {
        $active = "";
        $searchCase = isset($_GET['search']);
        $pageCase = isset($_GET['page']);
        $categoryCase = isset($_GET['category']);
        switch ([$categoryCase, $searchCase, $pageCase]) {
                // thay page
            case [true, true, true]:
            case [true, false, true]:
            case [false, true, true]:
            case [false, false, true]:
                $page = $_GET['page'];
                $url = str_replace("page=$page", "page=$i", $currentUrl);
                if ($i == $page) {
                    $active = "class = 'active'";
                }
                echo "<a href = '$url' $active>$i</a>";
                break;
                // thêm &page
            case [true, true, false]:
            case [true, false, false]:
            case [false, true, false]:
                if ($i == 1) {
                    $active = "class = 'active'";
                }
                echo "<a href = '$currentUrl&page=$i' $active>$i</a>";
                break;
            case [false, false, false]:
                if ($i == 1) {
                    $active = "class = 'active'";
                }
                echo "<a href = '$currentUrl?page=$i' $active>$i</a>";
                break;
            default:
                echo "Error";
        }
    } 
    $_SESSION['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
</div>