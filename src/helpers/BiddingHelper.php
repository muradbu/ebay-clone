<?php

class BiddingHelper
{
  /**
   *
   * Defines the minimal bid amount
   *
   * @param int $price The price of the product to check the minimal bid amount
   *
   * @return int Return the minimal bid amount.
   * 
   */
  public static function defineMinimalAmount($price)
  {
    $price = floatval($price);
    if ($price < 50) return 0.5;
    else if ($price < 500) return 1;
    else if ($price < 1000) return 5;
    else if ($price < 5000) return 10;
    else return 50;
  }
}
