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

        $date1 = strtotime("$endDate $endTime");
        $date2 = strtotime(date('Y-m-d H:i:s'));

        $zero = '0';

        $diff = abs($date2 - $date1);

        $years = floor($diff / (365 * 60 * 60 * 24));

        $months = floor(($diff - $years * 365 * 60 * 60 * 24)
            / (30 * 60 * 60 * 24));


        $days = floor(($diff - $years * 365 * 60 * 60 * 24 -
            $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));


        $hoursdiff = floor(($diff - $years * 365 * 60 * 60 * 24
            - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24)
            / (60 * 60));

        $hours = floor(($diff)
            / (60 * 60));

        $minutes = floor(($diff - $years * 365 * 60 * 60 * 24
            - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
            - $hoursdiff * 60 * 60) / 60);


        $seconds = floor(($diff - $years * 365 * 60 * 60 * 24
            - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
            - $hoursdiff * 60 * 60 - $minutes * 60));

        if (strlen($minutes) == 1) {
            $zero .= $minutes;
        }

        if (strlen($seconds) == 1) {
            $zero .= $seconds;
        }

        return "$hours:$minutes:$seconds";
    }
}
