<?php
require_once('controllers/UserController.php');
require_once('controllers/BiddingController.php');
require_once('controllers/FileController.php');
require_once("views/shared/objectCards/horizontal-sm.php");
require_once('helpers/ProductHelper.php');

//$products = BiddingController::getFromPerson($_SESSION['authenticated']['Username']);

?>

<?php if ($products == null) { ?>
    <p>Je hebt nog geen biedingen gedaan!</p>
<?php } else { ?>

    <div class="row">
        <div class="col-12 text-right">
            <p>Resultaat 1-9 van de 300 worden gebruikt</p>
        </div>
    </div>
    <div class="row" style="padding-bottom: 30px;">
        <div class="col-md-6 col-sm-12">
            <select class="form-control w-100">
                <option>Mijn biedingen</option>
                <option>Gewonnen</option>
                <option>Verloren</option>
            </select>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <p class="float-right">Sorteren op: </p>
                </div>
                <div class="col-md-6 col-sm-12">
                    <select class="form-control w-100 float-right">
                        <option>Tijd</option>
                        <option>Status</option>
                        <option>Verloren</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php foreach ($products as $key => $product) { ?>
            <div class="col-lg-4 mt-2">
                <?php echo HorizontalSm::generate(
                            [
                                "title" => $product["Title"],
                                "price" => number_format($product['Price'], 2),
                                "duration" => ProductHelper::getDurationTimer($product),
                                "productId" => $product["ProductId"],
                                "biddedPrice" => 0
                            ],
                            FileController::get($product["ProductId"], "ProductId", 1)
                        ); ?>
            </div>
        <?php } ?>
    </div>

    <div class="col-12">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
<?php } ?>