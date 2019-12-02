<?php

require_once('helpers/ModelHelper.php');

class Product extends ModelHelper
{
    public $productid;
    public $title;
    public $description;
    public $startingprice;
    public $paymentmethod;
    public $paymentinstruction;
    public $cityname;
    public $country;
    public $duration;
    public $durationstartdate;
    public $durationstarttime;
    public $shippingcosts;
    public $shippinginstructions;
    public $seller;
    public $buyer;
    public $durationenddate;
    public $durationendtime;
    public $auctionclosed;
    public $price;

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
}
