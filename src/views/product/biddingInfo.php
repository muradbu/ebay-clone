<?php
require_once("helpers/BiddingHelper.php");
require_once("helpers/ProductHelper.php");
require_once('controllers/BiddingController.php');
require_once("controllers/FeedbackController.php");

$errors = [];

if (isset($_POST['Feedback'])) {
  redirect("/gebruiker/veilingen/" . $_POST['productId'] . "/feedback");
}

if (isset($_POST['quickBid'])) {
  $errors = BiddingController::quickBid($product['ProductId'], $_POST['quickBid']);
}
if (isset($_POST['ProductId'])) {
  $errors = BiddingController::post($_POST);
}

$biddings = Bidding::query("519519591519", "WHERE ProductId = " . $product['ProductId'] . " ORDER BY BidAmount DESC");

if ($product["Price"] > 0) {
  $minimalAmount = round(BiddingHelper::defineMinimalAmount($product["Price"]), 2);
} else {
  $minimalAmount = round(BiddingHelper::defineMinimalAmount($product["StartingPrice"]), 2);
}


?>
<div class="h-100 card bg-light-grey">
  <div class="card-header">
    <?php
    if (!$product['AuctionClosed']) {
    ?>
      <div class="timer">
        <h2 class="text-center"><?php echo ProductHelper::getDurationTimer($product); ?></h2>
      </div>
    <?php
    }
    ?>
  </div>
  <div class="card-body bg-grey" id="biddings">
    <div id="current-biddings" class="<?php echo $product["ProductId"]; ?>">
      <?php
      if ($product["AuctionClosed"] && $product['Buyer']) {
        echo ("<h1 style='position: relative; top: 50%; transform: translateY(-50%);'>De veiling is gesloten!</h1>
    <h3>" . $biddings[0]["Username"] . " is de winnaar. Gefeliciteerd!</h3>
    ");
        if ($_SESSION['authenticated']['Username'] == $product['Buyer'] && empty(FeedbackController::get($product["ProductId"], "ProductId"))) {
          echo ("<form methode='POST' action='/gebruiker/veilingen/" . $product['ProductId'] . "/feedback'>     
       <button type='submit' name='Feedback' class='w-100 btn btn-primary text-white cut-text'>
          Verstuur verkoper feedback 
       </button>
     </form>");
        }
      } elseif (!$product["AuctionClosed"]) {
      ?>
        <table width="100%" id="product-bid-table" class="table no-border">
          <?php foreach ($biddings as $key => $bidding) {
            $bidDate = $bidding["BidDate"];
            $bidTime = $bidding["BidTime"];
            if ($key == 0) { ?>
              <tr>
                <th id="bidAmountHeader">
                  <?php echo numberToEuro($bidding["BidAmount"]); ?>
                </th>
                <th id="bidDateTimeHeader">
                  <?php echo date("d-m-Y H:i:s", strtotime("$bidDate $bidTime")); ?>
                </th>
                <th id="bidUsernameHeader">
                  <?php echo $bidding["Username"]; ?>
                </th>
              </tr>
            <?php } else if ($key <= 2) { ?>
              <tr>
                <td id="bidAmount<?php echo $key; ?>">
                  <?php echo numberToEuro($bidding["BidAmount"]); ?>
                </td>
                <td id="bidDateTime<?php echo $key; ?>">
                  <?php echo date("d-m-Y H:i:s", strtotime("$bidDate $bidTime")); ?>
                </td>
                <td id="bidUsername<?php echo $key; ?>">
                  <?php echo $bidding["Username"]; ?>
                </td>
              </tr>
            <?php }
          }
          if (count($biddings) - 3 >= 1) { ?>
            <tr>
              <td> Er <?php if (count($biddings) - 3 != 1) {
                        echo "zijn (";
                      } else {
                        echo "is (";
                      }
                      echo count($biddings) - 3; ?>) meer bieding<?php if (count($biddings) - 3 != 1) echo "en"; ?> </td>
            </tr>
          <?php
          }
          ?>
        </table>
    </div>
    <form method="post" style="all:none;">
      <input type="hidden" name="ProductId" value="<?php echo $product['ProductId']; ?>">
      <div class="row py-3">
        <div class="col-lg-8">
          <input class="form-control mt-2" name="BidAmount" id="BidAmount" type="number" value="<?php echo round(floatval($product['Price']), 2) + $minimalAmount ?>" />
          <div class="invalid-feedback"><?php echo $errors['error'] ?? ''; ?></div>
        </div>
        <div class="col-lg-4">
          <?php
          if (isset($_SESSION['authenticated'])) {
          ?>
            <button class='btn btn-primary text-white w-100 mt-2' type="submit">Bied</button>
          <?php
          } else {
          ?>
            <a class='btn btn-primary text-white w-100 mt-2' href="/inloggen">Inloggen</a>
          <?php
          }
          ?>
        </div>
      </div>
    </form>

    <div class="row">
      <form method="post" class="col-lg-4 mt-2">
        <button type="submit" name="quickBid" class="btn btn-primary text-white w-100" value="<?php echo $minimalAmount; ?>">
          + <?php echo numberToEuro($minimalAmount); ?>
        </button>
      </form>
      <form method="post" class="col-lg-4 mt-2">
        <button type="submit" name="quickBid" class="btn btn-primary text-white w-100" value="<?php echo $minimalAmount * 2; ?>">
          + <?php echo numberToEuro($minimalAmount * 2); ?>
        </button>
      </form>
      <form method="post" class="col-lg-4 mt-2">
        <button type="submit" name="quickBid" class="btn btn-primary text-white w-100" value="<?php echo $minimalAmount * 3; ?>">
          + <?php echo numberToEuro($minimalAmount * 3); ?>
        </button>
      </form>
    </div>
  <?php
      } else {
  ?>
    <div>
      <h2>Deze veiling is gesloten.</h2>
      <h3>Er zijn geen winnaars</h3>
    </div>
  <?php } ?>
  </div>
</div>