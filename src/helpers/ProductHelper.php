<?php

class ProductHelper
{
    /**
     *
     * Calculate the duration from the product for the timer
     *
     * @param Product The product where the duration need to calculate from
     *
     * @return DateInterval Returns the dateinterval
     *
     */
  public static function getDurationTimer($product)
  { 
    $endDate = $product['DurationEndDate'];
    $endTime = $product['DurationEndTime'];
    $interval = date_diff(
        new DateTime(
            date(
            'Y-m-d H:i:s',
            strtotime("$endDate $endTime")
            )
        ),
        new DateTime(
            date('Y-m-d H:i:s')
        )
    );

    return $interval->format('%H:%I:%S');
  }
}
