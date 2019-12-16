<?php

require_once("views/shared/objectCards/horizontal-sm.php");
require_once("controllers/BiddingController.php");
require_once("controllers/FileController.php");
require_once("helpers/ProductHelper.php");

$auctions = BiddingController::getLosingFromPerson($_SESSION["authenticated"]["Username"]);
?>

<li class="nav-item dropdown">
    <a class=" active nav-link dropdown-toggle " href="#" id="navbardrop" data-toggle="dropdown">Biedingen
        <?php
        if (count($auctions) > 0) {
            ?>
            <span class="badge badge-danger"><?php echo sizeof($auctions); ?></span>
        <?php
        }
        ?>
    </a>
    <div class="dropdown-menu dropdown-menu-right myBiddingsDropdown">
        <?php
        if (count($auctions) > 0) {
            foreach (array_slice($auctions, 0, 3) as $value => $auction) {
                echo HorizontalSm::generate([
                    "title" => $auction["Title"],
                    "price" => $auction['Price'],
                    "duration" => ProductHelper::getDurationTimer($auction),
                    "productId" => $auction["ProductId"],
                    "track" => ($auction["BidAmount"] !== null),
                    "biddedPrice" => $auction["BidAmount"],
                    "winning" => ($auction["Buyer"] === ($_SESSION['authenticated']['Username'] ?? false))
                ], FileController::get($auction["ProductId"], "ProductId", 1));
            } ?>
            <div style="margin:10px"><a href="gebruiker/biedingen-verliezen">Klik hier voor resterende biedingen (<?php echo count($auctions) - count(array_slice($auctions, 0, 3)); ?>).</a></div>
        <?php
        } else {
            ?>
            <div style="margin:15px">
                <p>Gemaakte biedingen waar je niet de hoogste bieder bent worden hier weergegeven.</p>
                <a href="gebruiker/biedingen">Mijn biedingen</a>
            </div>
        <?php
        }
        ?>
    </div>
</li>