<?php
require_once("controllers/ProductController.php");
require_once("controllers/FileController.php");
require_once("controllers/UserController.php");

$product = Product::get(filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_NUMBER_INT), 'ProductId', 1);
$feedback = UserController::getFeedbackCount($product["Seller"]);
$averageFeedback = 0;

if ( $feedback["allFeedbackRating"] != null){
    $averageFeedback = round($feedback["allFeedbackRating"] / $feedback["allFeedbackCount"],0);
}

if (!isset($product)) {
    redirect("/404");
}

$images = FileController::query("519519591519", "WHERE ProductId = " . $product['ProductId'] . "");

?>
<div class="row justify-content-center py-2">
    <div class="col-lg-6 mt-2">
        <?php require_once("productInfo.php"); ?>
    </div>

    <div class="col-lg-6 mt-2">
        <?php require_once("biddingInfo.php"); ?>
    </div>
</div>

<div class="col-md-12 mt-2 w-100 justify-content-center py-2">
    <?php require_once("productTabs.php"); ?>
</div>