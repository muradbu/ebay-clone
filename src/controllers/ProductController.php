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
        return Product::get($id);
    }

    /**
     *
     * Create a new product
     *
     * @param array $data The data to create a new product.
     *
     */
    public static function post($data)
    {
        require_once('controllers/FileController.php');

        $product = Product::execute("SELECT TOP 1 * FROM Product ORDER BY ProductId DESC")[0];

        $newProduct = new Product($data);
        $newProduct->CityName = $_SESSION['authenticated']['CityName'];
        $newProduct->Country = $_SESSION['authenticated']['Country'];
        $newProduct->Seller = $_SESSION['authenticated']['Username'];
        $newProduct->Thumbnail = 'HELP';
        $newProduct->ProductId = intval($product['ProductId']) + 1;
        $newProduct->Price = $data['StartingPrice'];

        $newProduct->post();

        Product::execute("insert into [ProductCategory] (ProductId, CategoryId) values ($newProduct->ProductId, ". $data['CategoryId'] ."])");

        FileController::post($newProduct, $_FILES['photos']);
        redirect("/veiling/$newProduct->ProductId");
    }

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
            $product['Buyer'] = ($product['Buyer'] === $_SESSION['authenticated']['Username']);
            return $product;
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

        return json_encode($products);
    }

    /**
     *
     * Get all auctions by a seller
     *
     * @param string The email address of a seller
     * @return Product Returns the product retrieved by the database
     *
     */
    public static function getFromPerson($seller)
    {
        return Product::query(10000000, "WHERE Seller = '$seller' ORDER BY DurationEndDate, DurationEndTime");
    }
    /**
     *
     * Get auction by seller which is closed or not
     *
     * @param string The email address of a seller
     * @param boolean Boolean which indicates if auction is closed
     * @return Product Returns the product retrieved by the database
     *
     */
    public static function getFromPersonByBool($seller, $closed)
    {
        return Product::query(10000000, "WHERE Seller = '$seller' AND AuctionClosed = '$closed' ORDER BY DurationEndDate, DurationEndTime");
    }

    /**
     *
     * Get total amount of active auctions
     *
     * @return Product Returns the products retrieved by the database
     *
     */
    public static function getAmount()
    {
        return Product::execute("SELECT COUNT(ProductId) as amount FROM Product WHERE AuctionClosed = 0");
    }

    /**
     *
     * Get auction by buyer which is closed or not
     *
     * @param string The username of a buyer
     * @param boolean Boolean which indicates if auction is closed
     * @return Product Returns the product retrieved by the database
     *
     */
    public static function getFromBuyerByBool($buyer, $closed)
    {
        return Product::query(10000000, "WHERE buyer = '$buyer' AND AuctionClosed = '$closed' ORDER BY DurationEndDate, DurationEndTime");
    }

    /**
     *
     * Gets int which indicates if product has received feedback.
     * return = 0: Product has not been found nor is the feedback
     * return = 1: Seller has not received feedback
     * return = 2: Seller has received feedback
     *
     * @param integer The product to search feedback for
     * @return Integer The index indicating if feedback is found
     *
     */
    public static function getFeedbackProduct($product)
    {
        return Product::execute("SELECT COUNT(*) as returnCode
        FROM (
            SELECT ProductId FROM Product WHERE ProductId = '$product'
            UNION ALL
            SELECT ProductId FROM Feedback WHERE ProductId = '$product'
        ) data");
    }
}
