<?php

require_once('helpers/BiddingHelper.php');


class HorizontalSm
{
    public static function generate($product, $file)
    {
        return "
        <div class='card h-100'>
            <div class='row no-gutters'>
                <div class='col-md-4'>
                    <div id= " . $product['productId'] . "img" . " style='min-height: auto; background-image: url(\"" . Config::LIVE_URL . "pics/" . $file['FileName'] . "\");' class='card-img-top h-100'></div>
                </div>
                <div class='col-md-8'>
                    <div class='card-body'>
                        <div class='row'>
                            <div class='col-12'>
                                <p class='cut-text font-weight-bold'>".$product["title"]."</p>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-7'>
                                <p class='update-price' id= ".$product['productId'] ."price" .">€ " . number_format($product['price'],2) . "</p>
                            </div>
                            <div class='col-5 text-right timer'>
                                <p id=".$product['productId']. "dur". " class=" . $product['productId'] . ">" . $product['duration'] . "</p> 
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-6'>
                                Jouw bod:
                            </div>
                            <div class='col-6 text-right'>
                                € ".number_format($product["biddedPrice"],2)."
                            </div>
                        </div>
                        <div class='row mt-2'>
                            <button type='submit' value='" . number_format(BiddingHelper::defineMinimalAmount($product['price']),2) . "' id=" . $product['productId'] . " href=" . $product['productId'] . " class='w-100 btn btn-primary text-white'>
                                Verhoog bod ( + € " . number_format(BiddingHelper::defineMinimalAmount($product['price']), 2) . ")
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
}
