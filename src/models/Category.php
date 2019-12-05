<?php

require_once('helpers/ModelHelper.php');

class Category extends ModelHelper
{
    public $CategoryId;
    public $CategoryName;
    public $SubCategory;
    public $IndexNumber;

    protected static $primaryKey = 'CategoryId';

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
