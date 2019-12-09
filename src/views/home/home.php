<?php
require_once('controllers/ProductController.php');
require_once('controllers/FileController.php');
$TopProducts = ProductController::getPopular(2);
require_once("views/shared/objectCards/lg.php");
?>

<div class="row text-center">
    <?php require_once("views/home/uniqueSellingPoints.php") ?>
</div>

<div class="row justify-content-center py-2">
    <?php
    foreach ($TopProducts as $key => $product) {
        echo "<div class=\"col-lg-6 col-md-6 col-sm-12 col-xs-12 py-3\">";
        echo Lg::generate(
            [
                "title" => $product["Title"],
                "price" => number_format($product['Price'], 2),
                "duration" => date('H:i:s', strtotime($product['Duration'])),
                "productId" => $product["ProductId"]
            ],
            FileController::get($product["ProductId"], "ProductId", 1)
        );
        echo "</div>";
    }
    ?>
</div>

<div class="row justify-content-center text-white py-4">
    <?php require_once("views/home/highlights.php") ?>
</div>

    <div class="col-md-12 col-lg-12 col-sm-12">
        <h2>Populaire veilingen</h2>
        <div class="row">
            <?php require("views/home/popularProducts.php") ?>
        </div>
    </div>

    <div class="col-md-12 col-lg-12 col-sm-12">
        <h2>Populaire veilingen</h2>
        <div class="row">
            <?php require("views/home/popularProducts.php") ?>
        </div>
    </div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card text-center pt-4 pb-5">
            <h1>Registreer</h1>
            <p>
                Registreer uw email en maak snel een account aan op eenmaal andermaal.
            </p>
            <div class="row">
                <div class="col-12 col-md-4 offset-0 offset-md-4">
                    <form method="post" action="/emailregistreren" class="row">
                        <div class="col">
                            <input type="email" name="email" class="form-control" placeholder="Emailadres">
                        </div>
                        <div class="col-3">
                            <button type="submit" name="submit" class="btn-primary btn">Registreer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>