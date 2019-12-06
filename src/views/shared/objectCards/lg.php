<?php

//todo: math the time left. create a javascript function for timer

class Lg
{
    public static function generate($product, $file)
    {
        return "
            <div class='card'>
            <div style='background-image: url(\" " . $file['filename'] . "\");' class='card-img-top'></div>
            <div class='card-body'>
              <h3 class='text-center'>" . $product['title'] . "</h3>
              <div class='row text-center'>
                <div class='col-sm-12 col-md-6 col-lg-6'>
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
