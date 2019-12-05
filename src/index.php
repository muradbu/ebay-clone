<?php

require('config.php');

session_start([
    'cookie_lifetime' => 14400,
]);

?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eenmaal Andermaal</title>
    <link rel="stylesheet" href="<?php echo Config::ROOT_FOLDER . "/css/app.css" ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <header class="mb-5">
        <?php require('views/shared/header.php'); ?>
    </header>

    <main role="main">
        <div class="py-4 bg-light" style="min-height: calc(100vh - 120px)">
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

    <footer class="footer mt-auto py-3">
        <div class="container">
            <?php require('views/shared/footer.php'); ?>
        </div>
    </footer>


    <script src="<?php echo Config::ROOT_FOLDER . "/js/jquery.min.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/bootstrap.min.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/timer.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/keepDropdownOpen.js" ?>" type="text/javascript"></script>
</body>

</html>