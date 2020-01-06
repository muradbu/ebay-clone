<?php
require_once('controllers/CategoryController.php');
$data = CategoryController::getCategoryAlphabetically();
?>
<div class="row justify-content-center">
    <div class="col-md-10 card">
        <div class="card-body">
            <ul class="nav justify-content-center">
                <?php
                foreach ($data as $key => $categories) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#<?php echo $key; ?>"><?php echo $key; ?></a>
                    </li>
                <?php
                }
                ?>
            </ul>
            <?php
            foreach ($data as $key => $categories) {
            ?>
                <div class="col-md-12 text-left">
                    <h2 id="<?php echo $key; ?>" class="alphanumeric mt-4"><?php echo $key; ?></h2>
                    <?php foreach ($categories as $category) { ?>
                        <h4 class="mt-4"><?php echo $category["CategoryName"]; ?></h4>
                        <div class="row text-left col-md-12 col-md-12">
                            <div class="col-md-4">
                                <?php foreach ($category["SubCategories"] as $key => $subCategory) { ?>
                                    <?php if (round(count($category["SubCategories"]) / 3) == $key || round(count($category["SubCategories"]) / 3) * 2 == $key) { ?>
                            </div>
                            <div class="col-md-4">
                            <?php } ?>
                            <div class="row">
                                <a href="#">
                                    <?php echo $subCategory["CategoryName"]; ?>
                                </a>
                            </div>
                        <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>