<?php

require_once('helpers/ModelHelper.php');

class User extends ModelHelper
{
    public $username;
    public $firstname;
    public $lastname;
    public $address1;
    public $address2;
    public $zipcode;
    public $cityname;
    public $country;
    public $dateofbirth;
    public $email;
    public $password;
    public $questionId;
    public $safetyanswer;
    public $seller;


    protected static $primaryKey = 'Username';

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
