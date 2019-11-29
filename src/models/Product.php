<?php

require('helpers/ModelHelper.php');

class Product extends ModelHelper
{
    public $ObjectId;
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
    public $DurationEndDate;
    public $DurationEndTime;
    public $AuctionClosed;
    public $Price;

    protected static $primaryKey = 'ObjectId';

    /**
     *
     * Get the primary key of the current class
     *
     * @return string Returns the primary key of the current class
     *
     */
    protected static function getPrimaryKey(){
        return static::$primaryKey;
    }
}

?>
