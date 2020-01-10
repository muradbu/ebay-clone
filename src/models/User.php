<?php

require_once('helpers/ModelHelper.php');

class User extends ModelHelper
{
    public $Username;
    public $FirstName;
    public $LastName;
    public $Address1;
    public $Address2;
    public $ZipCode;
    public $CityName;
    public $Country;
    public $DateOfBirth;
    public $Email;
    public $Password;
    public $QuestionId;
    public $SafetyAnswer;
    public $Seller;

    protected static $primaryKey = 'Username';

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists('User', $value))
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
