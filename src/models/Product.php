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

    protected static $primaryKey = 'ProductId';

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
            if (property_exists('Product', $value))
                $this->$key = $value;
        }
    }
}
