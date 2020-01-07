<?php
require_once('helpers/ModelHelper.php');


class Seller extends ModelHelper
{
    public $Username;
    public $BankName;
    public $BankAccountNumber;
    public $CheckOptionName;
    public $Creditcard;


    protected static $primaryKey = 'Username';

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

    public static function get($value, $column = "", $top = '9223372036854775807', $extend = "")
    {
        $array = parent::get($value, $column, $top, $extend);

        return new Seller($array);
    }
}
