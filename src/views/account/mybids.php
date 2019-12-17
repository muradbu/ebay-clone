<?php
require_once('controllers/UserController.php');
require_once('controllers/BiddingController.php');
require_once('controllers/FileController.php');
require_once("views/shared/objectCards/horizontal-sm.php");
require_once('helpers/ProductHelper.php');


switch(filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_NUMBER_INT)){
    case 0:
        $products = BiddingController::getFromPerson($_SESSION['authenticated']['Username']);
    break;
    case 1:
        $products = BiddingController::getWinningFromPerson($_SESSION['authenticated']['Username']);
    break;
    case 2:
        $products = BiddingController::getLosingFromPerson($_SESSION['authenticated']['Username']);
    break;
    default:
        $products = BiddingController::getFromPerson($_SESSION['authenticated']['Username']);
    break;
}

if (isset($_POST['submit'])){
    BiddingController::quickBid($_POST['productId'], $_POST['submit']);
}

?>

<div class="row">
    <div class="col-12 text-right">
        <!-- <p>Resultaat 1-9 van de 300 worden gebruikt</p> -->
    </div>
</div>
<div class="row" style="padding-bottom: 30px;">
    <div class="col-md-6 col-sm-12">        
        <div class="btn-group" role="group">
            <a href="/gebruiker/biedingen/0" class="btn btn-primary text-white">Alle biedingen</a>
            <a href="/gebruiker/biedingen/1" class="btn btn-primary text-white">Winnenden biedingen</a>
            <a href="/gebruiker/biedingen/2" class="btn btn-primary text-white">Verliezenden biedingen</a>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <!-- <div class="row">
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
        </div> -->
    </div>
</div>

<div class="row">
    <?php foreach ($products as $key => $product) { ?>
        <div class="col-lg-4 mt-2">
            <?php echo HorizontalSm::generate(
                [
                    "title" => $product["Title"],
                    "price" => $product['Price'],
                    "duration" => ProductHelper::getDurationTimer($product),
                    "productId" => $product["ProductId"],
                    "track" => ($product["BidAmount"] !== null),
                    "biddedPrice" => $product["BidAmount"],
                    "winning" => ($product["Buyer"] === ($_SESSION['authenticated']['Username'] ?? false))
                ],
                FileController::get($product["ProductId"], "ProductId", 1)
            ); ?>
        </div>
    <?php } ?>
</div>

<?php if($products == null){ ?>
    <div class="alert alert-primary" role="alert">Je hebt nog geen biedingen gedaan!</div>
<?php }?>

<div class="col-12 mt-4">
    <!-- <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Vorige</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Volgende</span>
                </a>
            </li>
        </ul>
    </nav> -->
</div>