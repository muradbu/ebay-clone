<?php
require_once('helpers/ModelHelper.php');


class Category extends ModelHelper
{
    public $catgoryId;
    public $categoryName;
    public $getSubcategorie;

    protected static $primaryKey = 'CategoryId';

    protected static function getPrimaryKey(){
        return static::$primaryKey;
    }


}

?>