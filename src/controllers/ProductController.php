<?php

require_once('models/Product.php');

class ProductController
{
    /**
     *
     * Get a specific product by id
     *
     * @param int $id The id for the product to be retrieved
     *
     * @return Product Returns the relevant product from the database
     *
     */
    public static function get($id)
    {
        Product::get($id);
    }

    /**
     *
     * Create a new product
     *
     * @param array $data The data to create a new product.
     *
     */
    public static function post($data)
    { }

    /**
     *
     * Edit a specific product
     *
     * @param int $id Id of the product to edit
     * @param array $data The data to edit the relevant product
     *
     */
    public static function put($id, $data)
    {
        $productToUpdate = Product::get($id);

        if (!is_array($productToUpdate))
            return ['productId' => 'Product bestaat niet.'];

        $product = new Product();

        foreach (array_keys($productToUpdate) as $value) {
            if (property_exists('Product', $value)) {
                $product->$value = str_replace("'", "''", $data[$value] ?? $productToUpdate[$value]);
            }
        }

        $product->put();
    }

    /**
     *
     * Get the first * products
     *
     * @param integer The amount of products returned
     * @return array Return a array with all the questions from the database
     *
     */
    public static function getNewest($amount)
    {
        return Product::execute("SELECT TOP $amount *, (SELECT MAX(BidAmount) FROM Bidding WHERE  ProductId = Product.ProductId AND Username = '" . ($_SESSION['authenticated']['Username'] ?? '') . "') as Tracked FROM Product WHERE AuctionClosed = 0 ORDER BY ProductId");
    }

    /**
     *
     * Get the first to close * products
     *
     * @param integer The amount of products returned
     * @return array Return a array with all the questions from the database
     *
     */
    public static function getFirstToClose($amount)
    {
        return Product::execute("SELECT TOP $amount *, (SELECT MAX(BidAmount) FROM Bidding WHERE  ProductId = Product.ProductId AND Username = '" . ($_SESSION['authenticated']['Username'] ?? '') . "') as Tracked FROM Product WHERE AuctionClosed = 0 ORDER BY DurationEndDate, DurationEndTime");
    }

    /**
     *
     * Get the most popular * products
     *
     * @param integer The amount of products returned
     * @return array Return a array with all the questions from the database
     *
     */
    public static function getPopular($amount)
    {
        return Product::execute("
            SELECT TOP $amount *,(
                SELECT COUNT(*)
                FROM Bidding
                WHERE ProductId = Product.ProductId
            ) AS BiddingCount, (SELECT MAX(BidAmount) FROM Bidding WHERE  ProductId = Product.ProductId AND Username = '" . ($_SESSION['authenticated']['Username'] ?? '') . "') as Tracked FROM Product WHERE AuctionClosed = 0 ORDER BY BiddingCount DESC
        ");
    }
    /**
     *
     * Get the most popular * products
     *
     * @param integer The amount of products returned
     * @param array A array of the ID's to skip
     * @return array Return a array with all the questions from the database
     *
     */
    public static function getPopularWithoutIds($amount, $ids)
    {

        return json_encode(Product::execute("
        SELECT TOP $amount *,(
            SELECT COUNT(*)
            FROM Bidding
            LEFT JOIN Product ON Product.ProductId = Bidding.ProductId
            ) as BiddingCount, (SELECT MAX(BidAmount) FROM Bidding WHERE  ProductId = Product.ProductId AND Username = '" . ($_SESSION['authenticated']['Username'] ?? '') . "') as Tracked
            from Product
            LEFT JOIN [File] ON [File].ProductId = Product.ProductId
            WHERE AuctionClosed = 0 AND Product.ProductId NOT IN ($ids) ORDER BY BiddingCount DESC
        "));
    }
    /**
     *
     * Get the TOP * products
     *
     * @param integer The amount of products returned
     * @param array A array of the ID's to skip
     * @return array Return a array with all the questions from the database
     *
     */
    public static function getTopWithoutIds($amount, $ids)
    {

        return json_encode(Product::execute("
        SELECT TOP $amount *,(
            SELECT COUNT(*)
            FROM Bidding
            LEFT JOIN Product ON Product.ProductId = Bidding.ProductId
            ) as BiddingCount, (SELECT MAX(BidAmount) FROM Bidding WHERE  ProductId = Product.ProductId AND Username = '" . ($_SESSION['authenticated']['Username'] ?? '') . "') as Tracked
            from Product
            LEFT JOIN [File] ON [File].ProductId = Product.ProductId
            WHERE AuctionClosed = 0 AND Product.ProductId NOT IN ($ids) ORDER BY DurationEndDate, DurationEndTime DESC
        "));
    }
    /**
     *
     * Get the newest * products
     *
     * @param integer The amount of products returned
     * @param array A array of the ID's to skip
     * @return array Return a array with all the questions from the database
     *
     */
    public static function getNewestWithoutIds($amount, $ids)
    {

        return json_encode(Product::execute("
        SELECT TOP $amount *,(
            SELECT COUNT(*)
            FROM Bidding
            LEFT JOIN Product ON Product.ProductId = Bidding.ProductId
            ) as BiddingCount, (SELECT MAX(BidAmount) FROM Bidding WHERE  ProductId = Product.ProductId AND Username = '" . ($_SESSION['authenticated']['Username'] ?? '') . "') as Tracked
            from Product
            LEFT JOIN [File] ON [File].ProductId = Product.ProductId
            WHERE AuctionClosed = 0 AND Product.ProductId NOT IN ($ids) ORDER BY ProductId DESC
        "));
    }

 /**
     *
     * Get the tracked productId and Buyer
     *
     * @param integer The amount of products returned
     * @param array A array of the ID's to skip
     * @return array Return a array with all the questions from the database
     *
     */
    public static function getTracked($ids)
    {
        $products = Product::execute("SELECT ProductId, Buyer From Product where ProductId in ($ids)");
        $products = array_map(function ($product) {
            return [$product['ProductId'] => ($product['Buyer'] === $_SESSION['authenticated']['Username'])];
        }, $products);

        return json_encode($products);
    }
 /**
     *
     * Get the price from ProductId
     *
     * @param integer The amount of products returned
     * @param array A array of the ID's to skip
     * @return array Return a array with all the questions from the database
     *
     */
    public static function getPrices($ids)
    {
        $products = Product::execute("SELECT ProductId, Price From Product where ProductId in ($ids)");
        $products = array_map(function ($product) {
            return [$product['ProductId'] => $product['Price']];
        }, $products);

        return json_encode($products);
    }
}
