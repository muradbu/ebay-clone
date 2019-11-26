<?php

    require_once('config.php');

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
    <link rel="stylesheet" href="<?php echo Config::ROOT_FOLDER . "/css/bootstrap.css" ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="<?php echo Config::ROOT_FOLDER . "/js/jquery.min.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER . "/js/bootstrap.js" ?>" type="text/javascript"></script>

</head>

<body>
    <header class="mb-5">
        <?php require('views/shared/header.php'); ?>
    </header>

    <main role="main">
        <div class="py-4 bg-light">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <?php
                        require('views/shared/breadcrumbs.php');
                        ?>
                        <?php require('routes.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-3 bg-secondary">
        <div class="container-fluid">
            <?php require('views/shared/footer.php'); ?>
        </div>
    </footer>
</body>

</html>