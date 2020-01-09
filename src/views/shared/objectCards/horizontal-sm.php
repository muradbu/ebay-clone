<?php

require_once('helpers/BiddingHelper.php');


class HorizontalSm
{
    public static function generate($product, $file)
    {
        return "
        <div class='card h-100 bidding " . (!$product['track'] ?: 'tracked ') . (!$product['winning'] ?: 'winning ') . "' data-id='" . $product['productId'] . "''>
            <div class='row no-gutters'>
                <div class='col-md-4'>
                    <div id= " . $product['productId'] . "img" . " style='min-height: auto; background-image: url(\"" . Config::LIVE_URL . "pics/" . $file['FileName'] . "\");' class='card-img-top h-100'></div>
                </div>
                <div class='col-md-8'>
                    <div class='card-body'>
                    <form method='POST'>
                        <div class='row'>
                            <div class='col-12'>
                                <p class='cut-text font-weight-bold'><a href='/veiling/" . $product['productId'] . "' >" . $product["title"] . "</a></p>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-7'>
                                <p class='update-price' id= " . $product['productId'] . "price" . ">" . numberToEuro($product['price']) . "</p>
                            </div>
                            <div class='col-5 text-right timer'>
                                <p id=" . $product['productId'] . "dur" . " class=" . $product['productId'] . ">" . $product['duration'] . "</p> 
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-5'>
                                Jouw bod:
                            </div>
                            <div class='col-7 text-right'>
                                " . numberToEuro($product["biddedPrice"]) . "
                            </div>
                        </div>
                        <input type='hidden' value='" . $product['productId'] . "' name='productId'/>
                        <div class='row mt-2'>
                            <button type='submit' value='" . BiddingHelper::defineMinimalAmount($product['price']) . "' name='submit' class='w-100 btn btn-primary text-white cut-text'>
                                Verhoog bod ( + " . numberToEuro(BiddingHelper::defineMinimalAmount($product['price'])) . ")
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
}
