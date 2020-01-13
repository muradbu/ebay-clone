<?php

class BiddingValidator
{
  /**
   *
   * Validate the amount of the bidding
   *
   * @param int $amount The amount send by the user.
   * @param int $maxBidAmount The highest bid of the requested product.
   *
   * @return array Return the error message or true
   * 
   */
  public static function validate($amount, $maxBidAmount)
  {
    if ($amount > 1000000)
      return ["error" => "Bedrag kan niet hoger zijn dan 1.000.000"];

    if ($amount <= $maxBidAmount)
      return ["error" => "De opgegeven waarde moet hoger zijn dan de hoogste bieding."];

    return true;
  }
}
