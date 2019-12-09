<?php
require_once("views/shared/objectCards/sm.php");
require_once("views/shared/objectCards/md.php");
require_once('controllers/ProductController.php');
$products = ProductController::getNewest(5);
?>
<div class="col-md-4 col-12 mt-3">
    <div class="row">
        <div class="col-12">
            <?php
            echo (Sm::generate(
                [
                    "title" => $products[0]["Title"],
                    "price" => number_format($products[0]['Price'], 2),
                    "duration" => date('H:i:s', strtotime($products[0]['Duration'])),
                    "productId" => $products[0]["ProductId"]
                ],
                FileController::get($products[0]["ProductId"], "ProductId", 1)
            ));
            ?>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <?php
            echo (Sm::generate(
                [
                    "title" => $products[1]["Title"],
                    "price" => number_format($products[1]['Price'], 2),
                    "duration" => date('H:i:s', strtotime($products[1]['Duration'])),
                    "productId" => $products[1]["ProductId"]
                ],
                FileController::get($products[1]["ProductId"], "ProductId", 1)

            ));
            ?>

        </div>
    </div>

</div>

<div class="col-md-4 col-12 mt-3">
    <?php
    echo (Md::generate(
        [
            "title" => $products[2]["Title"],
            "price" => number_format($products[2]['Price'], 2),
            "duration" => date('H:i:s', strtotime($products[2]['Duration'])),
            "productId" => $products[2]["ProductId"]
        ],
        FileController::get($products[2]["ProductId"], "ProductId", 1)

    ));
    ?>

</div>

<div class="col-md-4 col-12 mt-3">
    <div class="row">
        <div class="col-12">
            <?php
            echo (Sm::generate(
                [
                    "title" => $products[3]["Title"],
                    "price" => number_format($products[3]['Price'], 2),
                    "duration" => date('H:i:s', strtotime($products[3]['Duration'])),
                    "productId" => $products[3]["ProductId"]
                ],
                FileController::get($products[3]["ProductId"], "ProductId", 1)

            ));
            ?>

        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <?php
            echo (Sm::generate(
                [
                    "title" => $products[4]["Title"],
                    "price" => number_format($products[4]['Price'], 2),
                    "duration" => date('H:i:s', strtotime($products[4]['Duration'])),
                    "productId" => $products[4]["ProductId"]
                ],
                FileController::get($products[4]["ProductId"], "ProductId", 1)
            ));
            ?>

        </div>
    </div>