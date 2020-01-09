<?php

require_once('helpers/ModelHelper.php');

class Feedback extends ModelHelper
{

  public $ProductId;
  public $UserType;
  public $FeedbackTypeName;
  public $Date;
  public $Time;
  public $Comment;

  protected static $primaryKey = 'ProductId,UserType';

  public function __construct($data = [])
  {
      foreach ($data as $key => $value) {
          $this->$key = $value;
      }
  }

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
