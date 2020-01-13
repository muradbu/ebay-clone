<?php
require_once('models/Bidding.php');
require_once('helpers/biddingHelper.php');

class BiddingController
{
    /*
     * Get a specific bidding by id
     *
     * @param int $id The id for the bidding to be retrieved
     *
     * @return Bidding Returns the relevant bidding from the database
     *
     */
    public static function get($id)
    {
    }

    /**
     *
     * Create a new bidding
     *
     * @param array $data The data to create a new bidding.
     *
     */
    public static function post($data)
    {
        require_once("controllers/ProductController.php");

        if (!isset($_SESSION['authenticated']))
            return ["error" => "Login of maak een account aan om mee te bieden."];

        require_once("validators/BiddingValidator.php");

        $isValid = BiddingValidator::validate($data['BidAmount'], ProductController::get($data['Prod12uctId'])['Price']);

        if (is_array($isValid))
            return $isValid;

        $bidding = new Bidding();

        $bidding->ProductId = $data['ProductId'];
        $bidding->BidAmount = round($data['BidAmount'], 2);
        $bidding->Username = $_SESSION['authenticated']['Username'];
        $bidding->BidDate = date("m-d-Y");
        $bidding->BidTime = date("h:i:sa");

        require_once('models/Product.php');
        Product::execute("update [Product] set Price = $bidding->BidAmount, Buyer = '$bidding->Username' where ProductId = $bidding->ProductId");

        $bidding->post();
    }

    /**
     *
     * Execute a quick bidding
     *
     * @param int $productId The productId to create a new bidding.
     * @param int $amount The amount to bid
     *
     * @return array Return any errors or true
     *
     */
    public static function quickBid($productId, $amount)
    {
        if (!isset($_SESSION['authenticated']))
            redirect("inloggen");

        require_once("controllers/ProductController.php");

        $product = Product::get($productId);

        $bidding = [
            "ProductId" => $product['ProductId'],
            "BidAmount" => $product['Price'] + $amount
        ];

        $errors = BiddingController::post($bidding);

        if (is_array($errors))
            return $errors;

        redirect("/veiling/$productId");
    }

    /**
     *
     * Get the products the given user has bid on
     *
     * @param string $username The username to get the biddings.
     *
     * @return array Return the biddings of the user
     *
     */
    public static function getFromPerson($username)
    {
        return Bidding::execute("
        select *, (
            select max(BidAmount) from Bidding where ProductId = p.ProductId and Username = '$username' 
        ) as BidAmount from Product p
        where (select max(BidAmount) from Bidding where ProductId = p.ProductId and Username = '$username') is not null
        order by DurationEndDate, DurationEndTime asc
        ");
    }

    /**
     *
     * Get the losing biddings from person
     *
     * @param string $username The username to get the biddings.
     *
     * @return array Return the biddings of the user
     *
     */
    public static function getLosingFromPerson($username)
    {
        return Bidding::execute("
        select *, (
            select max(BidAmount) from Bidding where ProductId = p.ProductId and Username = '$username' 
        ) as BidAmount from Product p
        where (select max(BidAmount) from Bidding where ProductId = p.ProductId and Username = '$username') is not null
        and Buyer != '$username'
        AND AuctionClosed = 0
        order by DurationEndDate, DurationEndTime asc
        ");
    }

    /**
     *
     * Get the winning biddings from person
     *
     * @param string $username The username to get the biddings.
     *
     * @return array Return the biddings of the user
     *
     */
    public function getWinningFromPerson($username)
    {
        return Bidding::execute("
        select *, (
            select max(BidAmount) from Bidding where ProductId = p.ProductId and Username = '$username' 
        ) as BidAmount from Product p
        where Buyer = '$username'
        order by DurationEndDate, DurationEndTime asc
        ");
    }
}
