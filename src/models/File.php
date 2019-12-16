<?php
require_once('helpers/ModelHelper.php');


class File extends ModelHelper
{
    public $FileName;
    public $ProductId;


    protected static $primaryKey = 'FileName';

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
