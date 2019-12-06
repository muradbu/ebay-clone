<?php
require_once("controllers/CategoryController.php");

$rootCategories = CategoryController::getRootCategories();

?>

<ul class="dropdown-menu" id="navbarDropdownMega">
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="list-group" id="list-tab" role="tablist">
                <?php
                foreach ($rootCategories as $key => $value) {
                    ?>
                    <button type="button" class="btn btn-link list-group-item-action" id="list-<?php echo trim(preg_replace('/\s+/', '', $key)); ?>" data-toggle="list" href="#<?php echo trim(preg_replace('/\s+/', '', $key)); ?>" role="tab" aria-controls="<?php echo trim(preg_replace('/\s+/', '', $key)); ?>">
                        <?php echo $key; ?>
                    </button>
                <?php
                }
                ?>
                <button type="button" class="btn btn-link list-group-item-action">
                    <b><a href="/rubrieken">Alle rubrieken</a></b>
                </button>
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="tab-content" id="nav-tabContent">
                <?php
                foreach ($rootCategories as $key => $rootCategory) { ?>
                    <div class="tab-pane fade" id="<?php echo trim(preg_replace('/\s+/', '', $key)); ?>" role="tabpanel" aria-labelledby="list-<?php echo trim(preg_replace('/\s+/', '', $key)); ?>">
                        <div class="row">
                            <?php foreach ($rootCategory['SubCategories'] as $subCategory) { ?>
                                <div class="col-sm-6 col-md-6 col-lg-6 btn-group-vertical">
                                    <a href="#">
                                        <?php echo $subCategory['CategoryName'] ?>
                                    </a>
                                </div>
                            <?php
                                }
                                ?>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</ul>