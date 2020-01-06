<?php
require("helpers/SliderHelper.php");
?>
<div class="h-100 card">
    <div class="card-body">
        <h1><?php echo $product["Title"]; ?></h1>
        <div class="row">
            <div class="col-md-8">
                <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php echo SliderHelper::makeSlideIndicators($images); ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php echo SliderHelper::makeSlides($images); ?>
                    </div>
                    <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>

                    <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="detail-card-text">
                    <p><strong>Verzendkosten:</strong></p>
                    <p><?php echo numberToEuro($product["ShippingCosts"]); ?></p>
                </div>
                <div class="detail-card-text">
                    <p><strong>Aanbieder:</strong></p>
                    <p><?php echo $product["Seller"]; ?></p>
                </div>
                <div class="detail-card-text">
                    <p><strong>Plaats:</strong></p>
                    <p><?php echo $product["Country"] . ", " . $product["CityName"] ?></p>
                </div>
                <div class="detail-card-text">
                    <p><strong>Startprijs:</strong></p>
                    <p><?php echo numberToEuro($product["StartingPrice"]); ?></p>
                </div>
                <div class="detail-card-text">
                    <p><strong>Betaal methode:</strong></p>
                    <p><?php echo $product["PaymentMethod"]; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>