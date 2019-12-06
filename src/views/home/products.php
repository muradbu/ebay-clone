
    <?php
    require_once("views/shared/objectCards/sm.php");
    require_once("views/shared/objectCards/md.php");
    ?>

    <div class="col-md-4 col-12 mt-3">
        <div class="row">
            <div class="col-12">
                <?php echo Sm::generate(["title" => "test", "price" => "12134", "duration" => "00:00:05", "productId" => 1], ["filename" => Config::ROOT_FOLDER. "/img/twitter.png"]); ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <?php echo Sm::generate(["title" => "test", "price" => "12134", "duration" => "00:00:05", "productId" => 1], ["filename" => Config::ROOT_FOLDER. "/img/twitter.png"]); ?>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-12 mt-3">

        <?php echo Md::generate(["title" => "test", "price" => "12134", "duration" => "00:00:05", "productId" => 1], ["filename" => Config::ROOT_FOLDER. "/img/twitter.png"]); ?>
    </div>
    <div class="col-md-4 col-12 mt-3">
        <div class="row">
            <div class="col-12">
                <?php echo Sm::generate(["title" => "test", "price" => "12134", "duration" => "00:00:05", "productId" => 1], ["filename" => Config::ROOT_FOLDER. "/img/twitter.png"]); ?>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <?php echo Sm::generate(["title" => "test", "price" => "12134", "duration" => "00:00:05", "productId" => 1], ["filename" => Config::ROOT_FOLDER. "/img/twitter.png"]); ?>
            </div>
        </div>
    </div>
