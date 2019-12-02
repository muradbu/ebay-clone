
    <?php 
    require_once("views/shared/objectCards/sm.php");
    require_once("views/shared/objectCards/lg.php");

    echo Sm::generate(["title"=> "test", "price"=> "12134", "duration"=> "00:10:20", "productId" => 1], ["filename" => "test"]);
    echo Sm::generate(["title"=> "test", "price"=> "12134", "duration"=> "00:10:20", "productId" => 1], ["filename" => "test"]);
    echo Lg::generate(["title"=> "test", "price"=> "12134", "duration"=> "00:10:20", "productId" => 1], ["filename" => "test"]);
    echo Sm::generate(["title"=> "test", "price"=> "12134", "duration"=> "00:10:20", "productId" => 1], ["filename" => "test"]);
    echo Sm::generate(["title"=> "test", "price"=> "12134", "duration"=> "00:10:20", "productId" => 1], ["filename" => "test"]);
    ?>
