<?php

require_once('helpers/ModelHelper.php');

class Question extends ModelHelper
{
    public $questionid;
    public $question;

    protected static $primaryKey = 'QuestionId';

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
