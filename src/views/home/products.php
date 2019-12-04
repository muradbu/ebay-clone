
    <?php
    require_once("views/shared/objectCards/sm.php");
    require_once("views/shared/objectCards/lg.php");

    echo Sm::generate(["title" => "test", "price" => "12134", "duration" => "00:00:05", "productId" => 1], ["filename" => "localhost/src/img/twitter.png"]);
    echo Sm::generate(["title" => "test", "price" => "12134", "duration" => "00:00:05", "productId" => 2], ["filename" => "localhost/src/img/twitter.png"]);
    echo Lg::generate(["title" => "test", "price" => "12134", "duration" => "00:00:05", "productId" => 5], ["filename" => "localhost/src/img/twitter.png"]);
    echo Sm::generate(["title" => "test", "price" => "12134", "duration" => "00:00:05", "productId" => 4], ["filename" => "localhost/src/img/twitter.png"]);
    echo Sm::generate(["title" => "test", "price" => "12134", "duration" => "00:00:05", "productId" => 6], ["filename" => "localhost/src/img/twitter.png"]);
    ?>
