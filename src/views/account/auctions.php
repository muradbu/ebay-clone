<?php
require_once('controllers/UserController.php');
require_once('controllers/ProductController.php');
require_once('controllers/FileController.php');
require_once("views/shared/objectCards/horizontal-auction-cards.php");
require_once('helpers/ProductHelper.php');
require_once('constants/AuctionTab.php');

if (isset($_POST['productId'])) {
  ProductController::execute("UPDATE Product SET [DurationStartDate] = '". date('Y-m-d'). "', [DurationStartTime] = '" . date('h:i:s.u') . "' WHERE ProductId = " . $_POST['productId'] . "");
}

switch (basename($_SERVER['REQUEST_URI'])) {
  case AuctionTab::ALLE:
    $title = 'Alle veilingen';
    $products = ProductController::getFromPerson($_SESSION['authenticated']['Username']);
    $buttons = '<a href="/gebruiker/veilingen/0" class="btn btn-primary text-white active">Alle veilingen</a>
    <a href="/gebruiker/veilingen/1" class="btn btn-primary text-white">Actieve veilingen</a>
    <a href="/gebruiker/veilingen/2" class="btn btn-primary text-white">Verlopen veilingen</a>';
    break;
  case AuctionTab::ACTIEVE:
    $title = 'Actieve veilingen';
    $products = ProductController::getFromPersonByBool($_SESSION['authenticated']['Username'], 0);
    $buttons = '<a href="/gebruiker/veilingen/0" class="btn btn-primary text-white">Alle veilingen</a>
    <a href="/gebruiker/veilingen/1" class="btn btn-primary text-white active">Actieve veilingen</a>
    <a href="/gebruiker/veilingen/2" class="btn btn-primary text-white">Verlopen veilingen</a>';
    break;
  case AuctionTab::VERLOPEN:
    $title = 'Verlopen veilingen';
    $products = ProductController::getFromPersonByBool($_SESSION['authenticated']['Username'], 1);
    $buttons = '<a href="/gebruiker/veilingen/0" class="btn btn-primary text-white">Alle veilingen</a>
    <a href="/gebruiker/veilingen/1" class="btn btn-primary text-white">Actieve veilingen</a>
    <a href="/gebruiker/veilingen/2" class="btn btn-primary text-white active">Verlopen veilingen</a>';
    break;
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

<?php if ($products == null) { ?>
  <div class="alert alert-primary" role="alert">Je hebt nog geen veilingen gemaakt!</div>
<?php } else { ?>
  <div class="row">
    <?php
    foreach ($products as $key => $product) { ?>
      <div class="col-lg-4 mt-2">
        <?php echo HorizontalAuctionCards::generate(
          [
            "title" => $product["Title"],
            "price" => $product['Price'],
            "duration" => ProductHelper::getDurationTimer($product),
            "productId" => $product["ProductId"],
            "closed" => $product["AuctionClosed"],
            "days" => $product["Duration"],
            "StartingPrice" => $product["StartingPrice"]
          ],
          FileController::get($product["ProductId"], "ProductId", 1)
        ); ?>
      </div>
  <?php }
  } ?>
  </div>