<?php

class BiddingHelper
{
  public static function defineMinimalAmount($price)
  {
    if ($price < 1 && $price <= 50) {
      return 0.5;
    } else if ($price > 50 &&  $price <= 500) {
      return 1;
    } else if ($price > 500 && $price <= 1000) {
      return 5;
    } else if ($price > 1000 && $price <= 5000) {
      return 10;
    } else if ($price > 5000) {
      return 50;
    }
    return 5;
  }
}
