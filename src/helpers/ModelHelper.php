<?php

require_once('helpers/ConnectHelper.php');

abstract class ModelHelper
{

    /**
     *
     * Generates the sql statement to retrieve a single object of the relevant table in the database
     * Get is a static function. You can call the function this way: Model::get($id);
     *
     * @param int $id The id of the object to retrieve from the database
     *
     * @return array Returns the relevant object
     *
     */
    public static function get($value, $column = "", $top = '9223372036854775807', $extend = "")
    {
        $table = get_called_class();

        if ($column == "")
            $column = static::getPrimaryKey();

        $sql = "select top($top) * from [$table] where $column = $value $extend";

        return ConnectHelper::execute($sql)[0];
    }

    /**
     *
     * Generates the sql statement to retrieve all objects of the relevant table in the database
     * Query is a static function. You can call the function this way: Model::query();
     *
     * @return array Returns all the objects of the relevant table
     *
     */
    public static function query($top = '9223372036854775807', $extend = "")
    {
        $table = get_called_class();

        $sql = "select top($top) * from [$table] $extend";

        return ConnectHelper::execute($sql);
    }

    /**
     *
     * Generates the sql statement to create a new object in the database for the relevant table
     * Post is not a static function because it needs a filled model. You can call the fuction this way: $model->post();
     *
     * @return string Returns a message if the sql statement went well
     *
     */
    public function post()
    {
        $table = get_called_class();

        $columns = implode(',', array_keys(get_object_vars($this)));
        $values  = implode("','", get_object_vars($this));

        $sql = "insert into [$table] ($columns) values ('$values')";

        return ConnectHelper::execute($sql);
    }

    /**
     *
     * Generates the sql statement to edit a object in the database for the relevant table
     * Put is not a static function because it needs a filled model. You can call the fuction this way: $model->put();
     *
     * @return string Returns a message if the sql statement went well
     *
     */
    public function put()
    {
        $table = get_called_class();

        $values = array_map(function ($value, $key) {
            return "$key = '$value'";
        }, get_object_vars($this), array_keys(get_object_vars($this)));

        $values  = implode(",", $values);
        $primaryKey = static::getPrimaryKey();

        $sql = "update [$table] set $values where $primaryKey = " . $this->{static::getPrimaryKey()};

        return ConnectHelper::execute($sql);
    }

    /**
     *
     * Generates the sql statement to delete a object in the database for the relevant table
     * Delete is a static function. You can call the function this way: Model::delete($id);
     *
     * @return string Returns a message if the sql statement went well
     *
     */
    public static function delete($id)
    {
        $table = get_called_class();
        $primaryKey = static::getPrimaryKey();

        $sql = "delete from [$table] where $primaryKey = $id";

        return ConnectHelper::execute($sql);
    }

    /**
     *
     * Execute a custom sql statement
     * Execute is a static function. You can call the function this way: Model::execute($sql);
     *
     * @param string $sql the sql to be executed
     *
     * @return array Returns data or a message retrieved from the database
     *
     */
    public static function execute($sql)
    {
        return ConnectHelper::execute($sql);
    }

    /**
     *
     * Get the primary key from the called class
     *
     * @return string Returns the column name of the primary key from the relevant table
     *
     */
    protected abstract static function getPrimaryKey();
}
