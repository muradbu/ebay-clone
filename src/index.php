<?php

require('config.php');
require('helpers/GeneralHelpers.php');

session_start([
    'cookie_lifetime' => 14400,
]);

if (strpos($_SERVER['REQUEST_URI'], "api")) {
    require('routes.php');
    die();
}

?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eenmaal Andermaal</title>
    <link rel="stylesheet" href="<?php echo Config::ROOT_FOLDER . "/css/bootstrap.css" ?>">
    <link rel="stylesheet" href="<?php echo Config::ROOT_FOLDER . "/css/app.css" ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

    <script src="<?php echo Config::ROOT_FOLDER . "/js/jquery.min.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/bootstrap.min.js" ?>" type="text/javascript"></script>

    <script src="<?php echo Config::ROOT_FOLDER . "/js/store.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/timer.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/keepDropdownOpen.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/updateCards.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/moneyFormatter.js" ?>" type="text/javascript"></script>

    <!-- AJAX -->
    <script src="<?php echo Config::ROOT_FOLDER . "/js/ajax/getPopularWithoutIds.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/ajax/getCurrentBiddings.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/ajax/postBidding.js" ?>" type="text/javascript"></script>

</body>

</html>
