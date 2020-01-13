<?php

session_start([
    'cookie_lifetime' => 14400,
]);

require('config.php');
require('helpers/GeneralHelpers.php');
require_once('controllers/ProductController.php');

if (strpos($_SERVER['REQUEST_URI'], "api")) {
    require('routes.php');
    die();
}

if (isset($_SESSION['authenticated'])) {
    $products = ProductController::getFromBuyerByBool(str_replace(' ', '', $_SESSION['authenticated']["Username"]), 1);
}

?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EenmaalAndermaal</title>
    <link rel="stylesheet" href="<?php echo Config::ROOT_FOLDER . "/css/bootstrap.css" ?>">
    <link rel="stylesheet" href="<?php echo Config::ROOT_FOLDER . "/css/app.css" ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="<?php echo Config::ROOT_FOLDER . "/js/jquery.min.js" ?>" type="text/javascript"></script>
    <script src="https://unpkg.com/popper.js" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/bootstrap.min.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/timer.js" ?>" type="text/javascript"></script>
</head>

<body>
    <header class="mb-5">
        <?php require('views/shared/header/header.php'); ?>
    </header>

    <main role="main">
        <div class="pt-4 pb-5 bg-light" style="min-height: calc(100vh - 120px)">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <?php require('views/shared/breadcrumbs.php'); ?>
                    </div>
                </div>
                <?php
                if (isset($products)) {
                    foreach ($products as $product) {
                        if ($product["AuctionClosed"] == 1) {
                            if (ProductController::getFeedbackProduct($product["ProductId"])[0]["returnCode"] != 2) {
                ?>
                                <div class='alert alert-primary' role='alert'>
                                    Je hebt de veiling voor het product: <a href="/veiling/<?php echo $product["ProductId"]; ?>"><?php echo $product["Title"]; ?></a> gewonnen! Vergeet niet om de verkoper feedback te geven!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                <?php
                            }
                        }
                    }
                }
                ?>
                <div class="row justify-content-center">
                    <div class="col-sm-10 col-lg-10 col-md-10">
                        <?php require('routes.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer py-3 bg-primary">
        <?php require('views/shared/footer.php'); ?>
    </footer>

    <script src="<?php echo Config::ROOT_FOLDER . "/js/store.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/keepDropdownOpen.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/updateCards.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/moneyFormatter.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/sellerRegister.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/addStars.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/pictureViewer.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/tooltip.js" ?>" type="text/javascript"></script>

    <!-- AJAX -->
    <script src="<?php echo Config::ROOT_FOLDER . "/js/ajax/getPopularWithoutIds.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/ajax/getCurrentBiddings.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/ajax/postBidding.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/ajax/getCategoriesById.js" ?>" type="text/javascript"></script>

</body>

</html>