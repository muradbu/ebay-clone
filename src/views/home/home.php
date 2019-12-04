<?php

require_once("views/shared/objectCards/lg.php");

?>

<div class="row">
    <?php require_once("views/home/uniqueSellingPoints.php") ?>
</div>

<div class="row justify-content-center py-4">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 py-3">
        <?php echo Lg::generate(["title" => "test", "price" => "12134", "duration" => "00:10:20", "productId" => 23], ["filename" => "test"]); ?>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 py-3">
        <?php echo Lg::generate(["title" => "JAhoorrrr", "price" => "99999", "duration" => "00:10:20", "productId" => 13], ["filename" => "test"]); ?>
    </div>
</div>

<div class="row justify-content-center text-white py-4">
    <?php require_once("views/home/highlights.php") ?>
</div>

<div class="row py-4">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <h2>Populaire veilingen</h2>
        <div class="card-columns">
            <?php require("views/home/products.php") ?>
        </div>
    </div>
</div>

<div class="row py-4">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <h2>Nieuwste veilingen</h2>
        <div class="card-columns">
            <?php require("views/home/products.php") ?>
        </div>
    </div>
</div>