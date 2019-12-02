<?php

//todo: math the time left. create a javascript function for timer

class Md
{
    public static function generate($product, $file)
    {
        return "
            <div class='card'>
                <img src='" . $file['filename'] . "' class='card-img-top' alt='#' width='350px' height='300px' />
                <div class='card-body'>
                    <h5 class='card-title'>" . $product['title'] . "</h5>
                    <div class='row text-center'>
                        <div class='col-sm-6'>
                            <p>€ " . $product['price'] . "</p>
                        </div>
                        <div class='col-sm-6 timer'>
                            <p class='" . $product['productId'] . "'>" . $product['duration'] . "</p>
                        </div>
                    </div>
                    <div class='d-flex justify-content-center'>
                        <a id='" . $product['productId'] . "'class='btn btn-primary' href='" . $product['productId'] . "' >Verhoog bod</a>
                    </div>
                </div>
            </div>
        ";
    }
}
