<?php

//todo: math the time left. create a javascript function for timer

class Sm
{
    public static function generate($product, $file)
    {
        return "
            <div class='card product-card-sm'>
                <img src='src/img/twitter.png' class='card-img-top product-image img-responsive' alt='#' height='150px'/>
                <div class='card-body'>
                    <h5 class='card-title'>" . $product['title'] . "</h5>
                    <div class='row text-center'>
                        <div class='col-sm-6 col-md-6 col-lg-6'>
                            <p>€ " . $product['price'] . "</p>
                        </div>
                        <div class='col-sm-6 col-md-6 col-lg-6 timer'>
                        <p class=" . $product['productId'] . ">" . $product['duration'] . "</p>
                        </div>
                    </div>
                    <div class='d-flex justify-content-center'>
                        <a id=" . $product['productId'] . " href=" . $product['productId'] . " class='btn btn-primary'>Verhoog bod</a>
                    </div>
                </div>
            </div>
        ";
    }
}
