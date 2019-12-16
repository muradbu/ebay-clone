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
    // $expl_amount = explode('.', $amount);
    // if (!isset($expl_amount[1]) || strlen($expl_amount[1]) > 2 && strlen($expl_amount[0]) > 6) {
    //     return ["amount" => "De opgegeven waarde is niet correct."];
    // }

    if ($amount <= $maxBidAmount)
      return ["amount" => "De opgegeven waarde moet hoger zijn dan de hoogste bieding."];

    return true;
  }
}
