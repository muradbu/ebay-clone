<?php

class Lg
{
    public static function generate($product, $file)
    {
        return "
            <div class='card bidding " . (!$product['track'] ?: 'tracked ') . (!$product['winning'] ?: 'winning ') . "' data-id='" . $product['productId'] . "'>           
            <div id= " . $product['productId'] . "img" . " style='background-image: url(\"" . Config::LIVE_URL . "pics/" . $file['FileName'] . "\");' class='card-img-top'></div>
            <div class='card-body'>
            <form method='POST'>
                <h5 id='product " . $product['productId'] . "' class='card-title cut-text'><a href='/veiling/" . $product['productId'] . "'>" . $product['title'] . "</a></h5>
                <div class='row text-center'>
                    <div class='col-sm-6 col-md-6 col-lg-6'>
                        <p class='update-price' id= " . $product['productId'] . "price" . ">" . numberToEuro($product['price']) . "</p>
                    </div>
                    <div class='col-sm-6 col-md-6 col-lg-6 timer'>
                    <p id=" . $product['productId'] . "dur" . " class=" . $product['productId'] . ">" . $product['duration'] . "</p>
                    </div>
                </div>
                <div class='d-flex justify-content-center'>
                    <input type='hidden' value='" . $product['productId'] . "' name='productId'/>
                    <button type='submit' value='" . BiddingHelper::defineMinimalAmount($product['price']) . "' name='submit' class='btn btn-primary text-white cut-text'>
                        Verhoog bod ( + " . numberToEuro(BiddingHelper::defineMinimalAmount($product['price'])) . ")
                    </button>
                </div>
                </form>
            </div>
        </div>
        ";
    }
}
