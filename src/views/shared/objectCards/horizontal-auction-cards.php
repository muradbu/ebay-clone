<?php
class HorizontalAuctionCards
{
  public static function generate($product, $file)
  {
    $closedProduct = null;
    $textDays = null;

    if ($product['closed'] == 1) {
      if ($product["price"] != $product["StartingPrice"]) {
        $closedProduct = "<input class='btn btn-primary text-white btn-block' type='hidden' />";
        $textDays = "<div class='col-7 text-right'>Verlopen</div>";
      } else {
        $closedProduct = "<input class='btn btn-primary text-white btn-block' type='submit' name='duration' value='Veiling verlengen' />";
        $textDays = "<div class='col-7 text-right'>Verlopen</div>";
      }
    } else {
      $closedProduct = "<input class='btn btn-primary text-white btn-block' type='hidden' />";
      $textDays = "<div class='col-7 text-right timer'><p id=" . $product['productId'] . "dur" . " class=" . $product['productId'] . ">" . $product['duration'] . "</p></div>";
    }
    return "<div class='card h-100 bidding' data-id='" . $product['productId'] . "''>
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
                    <div class='col-5'>
                      <p>" . numberToEuro($product['price']) . "</p>
                    </div>
                      $textDays
                </div>
                <input type='hidden' value='" . $product['productId'] . "' name='productId'/>
                <input type='hidden' value='" . $product['days'] . "' name='days'/>
                $closedProduct
                </form>
            </div>
        </div>
    </div>
  </div>
  ";
  }
}
