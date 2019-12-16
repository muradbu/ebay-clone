<?php
require_once('models/File.php');
class FileController
{
    /**
     *
     * Get a specific files by from product
     *
     * @param int $id Of the product
     * 
     * @return File Returns the relevant category from the database
     *
     */
    public static function get($id, $column = "", $top = '9223372036854775807')
    {
        return File::get($id, $column, $top);
    }

    /**
     *
     * Generates the sql statement to retrieve all objects of the relevant table in the database
     * Query is a static function. You can call the function this way: Model::query();
     *
     * @return array Returns all the objects of the relevant table
     *
     */
    public static function query($top, $extend)
    {
        return File::query($top, $extend);
    }
}
