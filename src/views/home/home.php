<?php

require_once('controllers/FileController.php');
require_once('controllers/BiddingController.php');

if (isset($_POST['submit']))
    BiddingController::quickBid($_POST['productId'], $_POST['submit']);

?>
<div class="row text-center">
    <?php require_once("views/home/uniqueSellingPoints.php") ?>
</div>

<div class="row justify-content-center py-2 top">
    <?php require_once("views/home/topProducts.php") ?>
</div>

<div class="row justify-content-center text-white py-4">
    <?php require_once("views/home/highlights.php") ?>
</div>

<div class="col-12 popular">
    <h2>Populaire veilingen</h2>
    <div class="row">
        <?php require("views/home/popularProducts.php") ?>
    </div>
</div>

<div class="row py-4">
    <div class="col-12">
        <h2>Ervaringen</h2>
        <div class="row justify-content-center">
            <?php require_once("views/home/reviews.php") ?>
        </div>
    </div>
</div>

<div class="row py-4 new">
    <div class="col-12">
        <h2>Nieuwe veilingen</h2>
        <div class="row">
            <?php require("views/home/newestProducts.php") ?>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <?php require_once("views/home/register.php") ?>
        </div>
    </div>