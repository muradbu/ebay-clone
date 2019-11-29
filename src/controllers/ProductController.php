<?php

require_once('models/Product.php');

class ProductController
{
    /**
     *
     * Get the first * products
     *
     * @param integer The amount of products returned
     * @return array Return a array with all the questions from the database
     *
     */
    public static function getNewest($amount) {
        return Product::execute("SELECT TOP $amount * FROM Product WHERE AuctionClosed = 0 ORDER BY ProductId");
    }

    /**
     *
     * Get the first to close * products
     *
     * @param integer The amount of products returned
     * @return array Return a array with all the questions from the database
     *
     */
    public static function getFirstToClose($amount) {
        return Product::execute("SELECT TOP $amount * FROM Product WHERE AuctionClosed = 0 ORDER BY DurationEndDate, DurationEndTime");
    }

    /**
     *
     * Get the most popular * products
     *
     * @param integer The amount of products returned
     * @return array Return a array with all the questions from the database
     *
     */
    public static function getPopular($amount) {
        return Product::execute("
            SELECT TOP $amount *,(
                SELECT COUNT(*)
                FROM Bidding
                WHERE ProductId = Product.ProductId
            ) AS BiddingCount FROM Product WHERE AuctionClosed = 0 ORDER BY BiddingCount DESC
        ");
    }
}

?>
