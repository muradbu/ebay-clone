<?php
require_once("controllers/CategoryController.php");

$rootCategories = CategoryController::rootCategories();

?>

<ul class="dropdown-menu w-100" id="navbarDropdownMega">
    <div class="row">
        <div class="col-2">
            <div class="list-group" id="list-tab" role="tablist">
                <?php
                foreach ($rootCategories as $value) {
                    ?>
                    <button type="button" class="btn btn-link list-group-item-action" id="list-cat<?php echo $value['CategoryId'] ?>" data-toggle="list" href="#cat<?php echo $value['CategoryId'] ?>" role="tab" aria-controls="cat<?php echo $value['CategoryId'] ?>">
                        <?php echo $value['CategoryName']; ?>
                    </button>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-10">
            <div class="tab-content" id="nav-tabContent">
                <?php
                foreach ($rootCategories as $value) {
                    ?>
                    <div class="tab-pane fade" id="cat<?php echo $value['CategoryId'] ?>" role="tabpanel" aria-labelledby="list-cat<?php echo $value['CategoryId'] ?>">
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-4 btn-group-vertical">
                                <?php echo $value['CategoryId'] ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</ul>

<!-- <script>
    jQuery('.dropdown-toggle').on('click', function(e) {
        $(this).next().toggle();
    });
    jQuery('.dropdown-menu.keep-open').on('click', function(e) {
        e.stopPropagation();
    });
</script> -->