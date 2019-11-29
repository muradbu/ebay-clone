<?php
require_once('models/Category.php');
 class CategoryController{
    /**
     *
     * Get a specific category by id
     *
     * @param int $id The id for the category to be retrieved
     * 
     * @return Category Returns the relevant category from the database
     *
     */
    public static function get($id){
       
    }

    /**
     *
     * Get all categories
     * 
     * @return array Returns a array with all the categories in the database
     *
     */
    public static function query(){

    }
    
    /**
     *
     * Create a new category
     *
     * @param array $data The data to create a new category.
     *
     */
    public static function post($data){

    }
    
    /**
     *
     * Edit a specific category
     *
     * @param int $id Id of the category to edit
     * @param array $data The data to edit the relevant category
     *
     */
    public static function put($id, $data){

    }
    
    /**
     *
     * Delete a specific category
     *
     * @param int $id Id of the category to delete
     *
     */
    public static function delete($id){

    }

    /**
     * Get the main categories and his sub categories
     */
    public static function getCategoryAlphabetically(){
        $categories = Category::execute("SELECT * FROM Category WHERE Category.SubCategory = -1  ORDER BY Category.CategoryName;");
        
        $data = [];

        foreach($categories as $category){
                $category["SubCategories"] = Category::execute("SELECT * FROM Category WHERE Category.SubCategory =  ".$category["CategoryId"]." ORDER BY Category.CategoryName;");
            if(ctype_alnum($category["CategoryName"][0])){
                $data[$category["CategoryName"][0]][] = $category;
            }else{
                $data["#"][] = $category;
            }
        }

        return $data;
    }
}
?>
