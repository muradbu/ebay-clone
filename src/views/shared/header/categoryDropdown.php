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
                    echo "
                    <button type='button' class='btn btn-link list-group-item-action' id='list-" . trim(preg_replace('/\s+/', '', $key)) . "' data-toggle='list' href='#" . trim(preg_replace('/\s+/', '', $key)) . "' role='tab' aria-controls='" . trim(preg_replace('/\s+/', '', $key)) . "'>
                        $key
                    </button>
                ";
                }
                ?>
                <a href="/rubrieken" class="btn btn-link list-group-item-action text-primary font-weight-bold">
                    Alle rubrieken
                </a>
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