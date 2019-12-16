<?php

require_once('helpers/ModelHelper.php');

class Bidding extends ModelHelper
{
  public $ProductId;
  public $BidAmount;
  public $Username;
  public $BidDate;
  public $BidTime;

  protected static $primaryKey = 'ProductId,BidAmount';

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
