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
                        <span class="sr-only">Vorige</span>
                    </a>

                    <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Volgende</span>
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
                    <p>
                        <?php for($i = 0 ; $i < 5 ; $i++ ){ if($i < $averageFeedback){?>
                            <span class="material-icons star-filled-color">star</span>
                        <?php }else{ ?>                            
                            <span class="material-icons">star_border</span>                            
                        <?php }};?>
                         <span style="text-align: right; font-size: 25px; padding-bottom: 155px;"> (<?php echo $feedback["allFeedbackCount"]; ?>) </span>
                    </p>
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
                <a href="/contact/<?php echo $product["ProductId"] ?>" class="btn btn-primary text-white">Contact</a>
            </div>
        </div>
    </div>
</div>