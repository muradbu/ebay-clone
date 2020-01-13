<?php
    require_once('models/Category.php');
    require_once('controllers/CategoryController.php');
    require_once('controllers/FileController.php');
    require_once('controllers/BiddingController.php');
    require_once('helpers/ProductHelper.php');
    require_once('helpers/BiddingHelper.php');
    require_once('views/shared/objectCards/sm.php');

    if (isset($_POST['start']) || isset($_POST['end'])) {
        CategoryController::storeFilters();
    }
    $url = explode('/', preg_replace("/\?.{0,}/", "", $_SERVER['REQUEST_URI']));
    $category_id = end($url);
    $page = 1;
    if (isset($_GET['page'])) {
        $page = intval($_GET['page']);
    }
    $data = CategoryController::productsPage($category_id, $page);
    $startPagination = $page - 5;
    $endPagination = $page + 5;
    if ($startPagination < 1) {
        $startPagination = 1;
    }
    if ($endPagination > $data['pages']) {
        $endPagination = $data['pages'];
    }
    if (isset($_POST['submit']))
        BiddingController::quickBid($_POST['productId'], $_POST['submit']);
?>

<div class="row">
    <div class="col-3">
        <ul class="category-nav">
            <li class="font-weight-bold">Rubrieken</li>
            <li><a href="/rubrieken">Alle rubrieken</a></li>
            <li>
                <?php if (intval($data['parent']['CategoryId']) >= 0) { ?>
                    <a href="/rubrieken/<?php echo $data['parent']['CategoryId']; ?>"><?php echo $data['parent']['CategoryName']; ?></a>
                <?php } ?>
                <ul>
                    <li>
                        <?php echo $data['category']['CategoryName'] ?>
                        <ul>
                            <?php foreach ($data['subCategories'] as $subCategory) { ?>
                                <li><a href="/rubrieken/<?php echo $subCategory['CategoryId'] ?>"><?php echo $subCategory['CategoryName'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        <hr>
        <form method="post">
            Prijs
            <div class="form-row">
                <div class="form-group col-5">
                    <input type="number" min="0" class="form-control" name="start" id="start" value="<?php echo !isset($_SESSION['start']) ?: $_SESSION['start'] ?>">
                </div>
                <div class="col-2 text-center">
                    tot
                </div>
                <div class="form-group col-5">
                    <input type="number" min="0" class="form-control" id="end" name="end" value="<?php echo !isset($_SESSION['end']) ?: $_SESSION['end'] ?>">
                </div>
            </div>
            <button onclick="filterFormValidate(event)" class="btn btn-outline-primary" name="filter" type="submit">Filter</button>
        </form>
    </div>
    <div class="col-9 card">
        <div class="card-title">
            <?php if ($data['pages'] > 1) { ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mt-3">
                    <li class="page-item <?php echo $page > 1 ?: 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                        foreach (range($startPagination, $endPagination) as $num) {
                            echo '<li class="page-item ' . ($num == $page ? 'active' : "") . '"><a class="page-link" href="?page=' . $num . '">' . $num . '</a></li>';
                        }
                    ?>
                    <li class="page-item <?php echo $page + 1 <= $data['pages']  ?: 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php } ?>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                    if (count($data['products']) === 0) {
                        echo "Er zijn geen producten gevonden";
                    }
                    foreach ($data['products'] as $key => $product) {
                ?>
                    <div class="col-4">
                        <?php
                        echo (Sm::generate(
                            [
                                "title" => $product["Title"],
                                "price" => number_format($product['Price'], 2),
                                "duration" => ProductHelper::getDurationTimer($product),
                                "productId" => $product["ProductId"],
                                "track" => ($product["Tracked"] !== null),
                                "winning" => ($product["Buyer"] === ($_SESSION['authenticated']['Username'] ?? false))
                            ],
                            FileController::get($product["ProductId"], "ProductId", 1)
                        ));
                        ?>
                    </div>
                <?php
                        if ($key % 3 === 2) {
                          echo '</div><div class="row mt-3">';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>
