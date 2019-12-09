<?php
require_once('helpers/ModelHelper.php');


class File extends ModelHelper
{
    public $FileName;
    public $ProductId;


    protected static $primaryKey = 'FileName';

    protected static function getPrimaryKey(){
        return static::$primaryKey;
    }


}

?>