<?php

    require_once('config.php');
    
?>

<!doctype html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Eenmaal Andermaal</title>
        <link rel="stylesheet" href="<?php echo Config::ROOT_FOLDER ."/css/bootstrap.css" ?>">
    </head>
    <body>
    <header>
        <?php require('views/shared/header.php'); ?>
    </header>

    <main role="main" style="height:100%!important">
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12">
                        <?php require 'routes.php'; ?>
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

    <script src="<?php echo Config::ROOT_FOLDER ."/js/bootstrap.js" ?>" type="text/javascript"></script>
    <script src="<?php echo Config::ROOT_FOLDER ."/js/jquery.min.js" ?>" type="text/javascript"></script>
</body>
</html>

