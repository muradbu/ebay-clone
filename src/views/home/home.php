<?php

require_once("views/shared/objectCards/lg.php");

?>

<div class="row text-center">
    <?php require_once("views/home/uniqueSellingPoints.php") ?>
</div>

<div class="row justify-content-center py-2">
    <div class="col-md-6 col-12 py-3">
        <?php echo Lg::generate(["title" => "test", "price" => "12134", "duration" => "00:01:20", "productId" => 23], ["filename" => Config::ROOT_FOLDER . "/img/twitter.png"]); ?>
    </div>
    <div class="col-md-6 col-xs-12 py-3">
        <?php echo Lg::generate(["title" => "JAhoorrrr", "price" => "99999", "duration" => "00:01:20", "productId" => 13], ["filename" => Config::ROOT_FOLDER . "/img/twitter.png"]); ?>
    </div>
</div>

<div class="row justify-content-center text-white py-4">
    <?php require_once("views/home/highlights.php") ?>
</div>

<div class="row mt-3">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <h2>Populaire veilingen</h2>
        <div class="row">
            <?php require("views/home/products.php") ?>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <h2>Nieuwste veilingen</h2>
        <div class="row">
            <?php require("views/home/products.php") ?>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col">
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