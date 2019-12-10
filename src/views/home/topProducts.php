<?php

require_once('controllers/ProductController.php');

$TopProducts = ProductController::getPopular(2);
require_once("views/shared/objectCards/lg.php");

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
