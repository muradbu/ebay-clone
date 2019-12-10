<?php

require_once('helpers/BiddingHelper.php');

class Lg
{
    public static function generate($product, $file)
    {
        return "
            <div class='card'>
            <div style='background-image: url(\" pics/" . $file['FileName'] . "\");' class='card-img-top'></div>
            <div class='card-body'>
            <form type='POST' action=''>
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
                    <button type='submit' value='" . BiddingHelper::defineMinimalAmount($product['price']) . "' id=" . $product['productId'] . " href=" . $product['productId'] . " class='btn btn-primary text-white'>
                        Verhoog bod ( + € " . number_format(BiddingHelper::defineMinimalAmount($product['price']), 2) . ")
                    </button>
                </div>
                </form>
            </div>
        </div>
        ";
    }
}
