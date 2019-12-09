<?php
require_once('models/File.php');
 class FileController{
    /**
     *
     * Get a specific files by from product
     *
     * @param int $id Of the product
     * 
     * @return File Returns the relevant category from the database
     *
     */
    public static function get($id, $column = "",$top = '9223372036854775807'){
        return File::get($id,$column,$top);
    }
}
?>
