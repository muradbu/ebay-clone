<?php
require_once('models/Category.php');
require_once('models/Product.php');

class CategoryController
{

    /**
     *
     * Get a specific category by id
     *
     * @param int $id The id for the category to be retrieved
     *
     * @return Category Returns the relevant category from the database
     *
     */
    public static function get($id, $column = "CategoryId")
    {
        return Category::get($id, $column);
    }

    /**
     *
     * Get the data for the overview page of a specific category by id
     *
     * @param int $id The id for the category to be retrieved
     * @param int $page The page number
     *
     * @return array Category Returns the relevant category from the database
     *
     */
    public static function productsPage($id, $page = 1)
    {
        $category = Category::get($id);
        $parent = Category::get($category['SubCategory']);

        $subCategories = Category::execute("
            SELECT *
            FROM Category A
            WHERE SubCategory = $id
            ORDER BY IndexNumber
        ");
        if ($page === 0) {
            $page = 1;
        }
        $offset = ($page - 1) * 15;
        $sql = "";
        if (isset($_SESSION['start']) && $_SESSION['start']) {
            $sql = "AND p.Price >= ". $_SESSION['start'];
        }
        if (isset($_SESSION['end']) && $_SESSION['end']) {
            $sql .= "AND p.Price <= ". $_SESSION['end'];
        }
        $products = Product::execute("
            WITH tblChild AS
            (
                SELECT *
                    FROM Category WHERE SubCategory = $id OR CategoryId = $id
                UNION ALL
                SELECT Category.* FROM Category  JOIN tblChild  ON Category.SubCategory = tblChild.CategoryId
            )
            SELECT 
                *, 
                (SELECT MAX(BidAmount) FROM Bidding WHERE  ProductId = p.ProductId AND Username = '" . ($_SESSION['authenticated']['Username'] ?? '') . "') as Tracked 
            FROM Product p WHERE AuctionClosed = 0 AND EXISTS(SELECT ProductId FROM ProductCategory pc WHERE pc.CategoryId in (
                SELECT tblChild.CategoryId FROM tblChild
            ) AND pc.ProductId = P.ProductId)
            $sql
            ORDER BY p.DurationEndDate
             OFFSET $offset ROWS
             FETCH NEXT 15 ROWS ONLY
        ");

        $productCount = Product::execute("
            WITH tblChild AS
            (
                SELECT *
                    FROM Category WHERE SubCategory = $id OR CategoryId = $id
                UNION ALL
                SELECT Category.* FROM Category  JOIN tblChild  ON Category.SubCategory = tblChild.CategoryId
            )
            SELECT 
                COUNT(*) as Count
            FROM Product p WHERE AuctionClosed = 0 AND EXISTS(SELECT ProductId FROM ProductCategory pc WHERE pc.CategoryId in (
                SELECT tblChild.CategoryId FROM tblChild
            ) AND pc.ProductId = P.ProductId)
            $sql
        ");

        return [
            'parent' => $parent,
            'products' => $products,
            'subCategories' => $subCategories,
            'category' => $category,
            'pages' => floor($productCount[0]['Count'] / 16) + 1
        ];
    }

    public static function storeFilters()
    {
        $_SESSION['start'] = $_POST['start'];
        $_SESSION['end'] = $_POST['end'];
    }

    /**
     *
     * Get all categories by id
     *
     * @return array Returns an array with all the categories in the database
     *
     */
    public static function getMultipleById($id, $column = "CategoryId")
    {
        return Category::query(9223372036854775807, "where $column = $id");
    }

    /**
     *
     * Create a new category
     *
     * @param array $data The data to create a new category.
     *
     */
    public static function post($data)
    {
    }

    /**
     *
     * Edit a specific category
     *
     * @param int $id Id of the category to edit
     * @param array $data The data to edit the relevant category
     *
     */
    public static function put($id, $data)
    {
    }

    /**
     *
     * Delete a specific category
     *
     * @param int $id Id of the category to delete
     *
     */
    public static function delete($id)
    {
    }

    /**
     *
     * Get top 6 categories paired with subcategories. Function will be deleted and transformed into get populair
     *
     * @return array Returns an array with 6 categories and their subcategories
     *
     */
    public static function getRootCategories()
    {
        $data = [];
        $rootCategories = Category::execute("SELECT TOP 6 * FROM Category WHERE SubCategory = -1;");
        foreach ($rootCategories as $rootCategory) {
            $data[$rootCategory['CategoryName']]['SubCategories'] = Category::execute("SELECT TOP 10 * FROM Category WHERE Category.SubCategory =  " . $rootCategory["CategoryId"] . " ORDER BY Category.CategoryName");
        }

        return $data;
    }

    /**
     * Get the main categories and his sub categories
     */
    public static function getCategoryAlphabetically()
    {
        $categories = Category::execute("SELECT * FROM Category WHERE Category.SubCategory = -1  ORDER BY Category.CategoryName");

        $data = [];

        foreach ($categories as $category) {
            $category["SubCategories"] = Category::execute("SELECT * FROM Category WHERE Category.SubCategory =  " . $category["CategoryId"] . " ORDER BY Category.CategoryName;");
            if (ctype_alnum($category["CategoryName"][0])) {
                $data[$category["CategoryName"][0]][] = $category;
            } else {
                $data["#"][] = $category;
            }
        }

        return $data;
    }
}
