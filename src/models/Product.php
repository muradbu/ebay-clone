<?php

require_once('helpers/ModelHelper.php');

class Product extends ModelHelper
{
    public $ProductId;
    public $Title;
    public $Description;
    public $StartingPrice;
    public $PaymentMethod;
    public $PaymentInstruction;
    public $CityName;
    public $Country;
    public $Duration;
    public $DurationStartDate;
    public $DurationStartTime;
    public $ShippingCosts;
    public $ShippingInstructions;
    public $Seller;
    public $Buyer;
    public $Price;
    public $Thumbnail;
    public $AuctionClosed;

    protected static $primaryKey = 'ProductId';
    protected $fillable = ['Price', 'ProductId', 'Title', 'Description', 'StartingPrice', 'PaymentMethod', 'PaymentInstruction', 'CityName', 'Country', 'Duration', 'ShippingCosts', 'ShippingInstructions', 'Seller', 'Thumbnail'];

    /**
     *
     * Get the primary key of the current class
     * 
     * @return string Returns the primary key of the current class
     * 
     */
    protected static function getPrimaryKey()
    {
        return static::$primaryKey;
    }

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists('Product', $key))
                $this->$key = $value;
        }
    }
}
