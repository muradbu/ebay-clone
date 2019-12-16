<?php

require_once('helpers/ModelHelper.php');

class UserPhone extends ModelHelper
{
    public $username;
    public $phonenumber;

    protected static $primaryKey = 'Id';

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
