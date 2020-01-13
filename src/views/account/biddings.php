<?php
require_once('controllers/UserController.php');
require_once('controllers/BiddingController.php');
require_once('controllers/FileController.php');
require_once('controllers/ProductController.php');
require_once('controllers/FeedbackController.php');
require_once("views/shared/objectCards/horizontal-sm.php");
require_once('helpers/ProductHelper.php');

// TODO Text based (all, winning, losing)
switch (filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_NUMBER_INT)) {
    case 0:
        $title = 'Alle biedingen';
        $products = BiddingController::getFromPerson($_SESSION['authenticated']['Username']);
        $buttons = '<a href="/gebruiker/biedingen/0" class="btn btn-primary text-white active">Alle biedingen</a>
        <a href="/gebruiker/biedingen/1" class="btn btn-primary text-white">Actieve biedingen</a>
        <a href="/gebruiker/biedingen/2" class="btn btn-primary text-white">Verlopen biedingen</a>';
        break;
    case 1:
        $title = 'Winnende biedingen';
        $products = BiddingController::getWinningFromPerson($_SESSION['authenticated']['Username']);
        $buttons = '<a href="/gebruiker/biedingen/0" class="btn btn-primary text-white">Alle biedingen</a>
        <a href="/gebruiker/biedingen/1" class="btn btn-primary text-white active">Actieve biedingen</a>
        <a href="/gebruiker/biedingen/2" class="btn btn-primary text-white">Verlopen biedingen</a>';
        break;
    case 2:
        $title = 'Verliezende biedingen';
        $products = BiddingController::getLosingFromPerson($_SESSION['authenticated']['Username']);
        $buttons = '<a href="/gebruiker/biedingen/0" class="btn btn-primary text-white">Alle biedingen</a>
        <a href="/gebruiker/biedingen/1" class="btn btn-primary text-white">Actieve biedingen</a>
        <a href="/gebruiker/biedingen/2" class="btn btn-primary text-white active">Verlopen biedingen</a>';
        break;
    default:
        $title = 'Mijn biedingen';
        $products = BiddingController::getFromPerson($_SESSION['authenticated']['Username']);
        $buttons = '<a href="/gebruiker/biedingen/0" class="btn btn-primary text-white active">Alle biedingen</a>
        <a href="/gebruiker/biedingen/1" class="btn btn-primary text-white">Actieve biedingen</a>
        <a href="/gebruiker/biedingen/2" class="btn btn-primary text-white">Verlopen biedingen</a>';
        break;
}

if (isset($_POST['submit'])) {
    if(ProductController::get($_POST['productId'])["AuctionClosed"] == 1)
    {
        redirect("/gebruiker/veilingen/".$_POST['productId']."/feedback");
    }
    else{        
        BiddingController::quickBid($_POST['productId'], $_POST['submit']);
    }
}

?>

<h1><?php echo $title; ?></h1>

<div class="row" style="padding-bottom: 30px;">
    <div class="col-md-6 col-sm-12">
        <div class="btn-group" role="group">
            <?php echo $buttons; ?>
        </div>
    </div>
</div>

<div class="row">
    <?php foreach ($products as $key => $product) { ?>
        <div class="col-lg-4 mt-2">
            <?php if ($product["Buyer"] != $_SESSION["authenticated"]["Username"] && $product["AuctionClosed"] == 1) {}
            else if ($product["Buyer"] == $_SESSION["authenticated"]["Username"] && $product["AuctionClosed"] == 1 && !empty(FeedbackController::get($product['ProductId'], "ProductId")["ProductId"])) {}
             else{ echo HorizontalSm::generate(
                [
                    "title" => $product["Title"],
                    "price" => $product['Price'],
                    "duration" => ProductHelper::getDurationTimer($product),
                    "productId" => $product["ProductId"],
                    "track" => ($product["BidAmount"] !== null),
                    "biddedPrice" => $product["BidAmount"],
                    "winning" => ($product["Buyer"] === ($_SESSION['authenticated']['Username'] ?? false)),
                    "buyer" => ($product["Buyer"]),
                    "auctionClosed" => ($product["AuctionClosed"])
                ],
                FileController::get($product["ProductId"], "ProductId", 1)
            ); } ?>
        </div>
    <?php } ?>
</div>

<?php if ($products == null) { ?>
    <div class="alert alert-primary" role="alert">Je hebt nog geen biedingen gedaan!</div>
<?php } ?>