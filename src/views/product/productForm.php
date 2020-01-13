<?php

require_once 'controllers/CategoryController.php';
require_once 'controllers/ProductController.php';

$rootCategories = CategoryController::getMultipleById(-1, "SubCategory");
$errors = [];

if (isset($_POST['submit'])) {
    if (count($_FILES['photos']['name']) == 0) {
        $errors['Photos'] = "Geen foto's gekozen";
    } else if (count($_FILES['photos']['name']) > 5) {
        $errors['Photos'] = "Meer dan 5 foto's gekozen";
    } else {
        ProductController::post($_POST);
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card text-center">
            <div class="card-body">
                <img width="100" src="<?php echo Config::ROOT_FOLDER ?>/img/logo.svg">
                <h5 class="card-title">Product Toevoegen</h5>
                <h6 class="card-subtitle mb-2 text-muted">Vul alle gegevens in om een product toe te voegen.</h6>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="container text-left">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="card-title">Categorie kiezen</h6>
                                    <input name="CategoryId" id="CategoryId" type="hidden" value="">
                                </div>
                            </div>
                            <div id="dropdownparent" class="row">
                                <div id="categorydropdown1" style="margin: 5px 10px 10px 15px" name="categorydropdown">
                                    <div class="dropdown">
                                        <a id="dropdowntext1" class="btn dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 1px solid rgba(0, 0, 0, 0.15)!important;border-radius: 0.25rem;">Kies groep*</a>
                                        <div class="dropdown-menu scrollable-menu" onclick="getCategoryById(event.srcElement)">
                                            <?php foreach ($rootCategories as $value) {
                                                echo "<a name='1' id='" . $value['CategoryId'] . "' class='dropdown-item'>" . $value['CategoryName'] . "</a>";
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="card-title">Product gegevens</h6>
                                </div>
                                <div class="col-md-12">
                                    <label for="Title">Titel*</label>
                                    <input type="text" value="<?php echo $_POST['Title'] ?? "" ?>" name="Title" class="form-control <?php echo isset($errors['Title']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['Title'] ?? ''; ?></div>
                                </div>
                                <div class="col-md-4">
                                    <label for="StartingPrice">Startprijs</label>
                                    <input type="number" step="0.01" value="<?php echo $_POST['StartingPrice'] ?? "" ?>" name="StartingPrice" class="form-control <?php echo isset($errors['StartingPrice']) ? 'is-invalid' : ''; ?>">
                                    <div class="invalid-feedback"><?php echo $errors['StartingPrice'] ?? ''; ?></div>
                                </div>
                                <div class="col-md-4">
                                    <label for="Duration">Duur*</label>
                                    <select class="form-control <?php echo isset($errors['Duration']) ? 'is-invalid' : ''; ?>" name="Duration" id="Duration" required>
                                        <option value="1" <?php echo $_POST['Duration'] ?? null == "1" ? "selected" : '' ?>>1 Dag</option>
                                        <option value="3" <?php echo $_POST['Duration'] ?? null == "3" ? "selected" : '' ?>>3 Dagen</option>
                                        <option value="5" <?php echo $_POST['Duration'] ?? null == "5" ? "selected" : '' ?>>5 Dagen</option>
                                        <option value="7" <?php echo $_POST['Duration'] ?? null == "7" ? "selected" : !isset($_POST['Duration']) ? 'selected' : '' ?>>7 Dagen</option>
                                        <option value="10" <?php echo $_POST['Duration'] ?? null == "10" ? "selected" : '' ?>>10 Dagen</option>
                                    </select>
                                    <div class="invalid-feedback"><?php echo $errors['Duration'] ?? ''; ?></div>
                                </div>
                                <div class="col-md-12">
                                    <label for="Files">Foto's</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" multiple class="custom-file-input" id="photo" name="photos[]">
                                            <label class="custom-file-label" for="photo">Klik hier om foto's te uploaden</label>
                                        </div>
                                    </div>
                                    <small style="color: red;"><?php echo $errors['Photos'] ?? ''; ?></small>
                                    <div class="gallery"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card text-center mt-3">
                                        <div class="card-header">
                                            <ul class="nav nav-tabs card-header-tabs" id="pills-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#description" role="tab" aria-controls="pills-description" aria-selected="true">Beschrijving</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-description-tab" data-toggle="pill" href="#payment" role="tab" aria-controls="pills-description" aria-selected="true">Betaling</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="pills-description-tab" data-toggle="pill" href="#shipping" role="tab" aria-controls="pills-description" aria-selected="true">Verzending</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="text-left tab-pane active fade show" id="description" role="tabpanel" aria-labelledby="pills-description-tab">
                                                    <textarea required id="Description" name="Description" class="md-textarea form-control" placeholder="Beschrijf hier de beschrijving van het product*" rows="8"><?php echo $_POST['Description'] ?? "" ?></textarea>
                                                </div>
                                                <div class="text-left tab-pane fade show" id="payment" role="tabpanel" aria-labelledby="pills-description-tab">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="PaymentMethod">Betaalmethode*</label>
                                                            <select class="form-control <?php echo isset($errors['PaymentMethod']) ? 'is-invalid' : ''; ?>" name="PaymentMethod" id="PaymentMethod" required>
                                                                <option value="creditcard" <?php echo $_POST['PaymentMethod'] ?? null == "ceditcard" ? "selected" : '' ?>>CreditCard</option>
                                                                <option value="ideal" <?php echo $_POST['PaymentMethod'] ?? null == "3" ? "ideal" : '' ?>>IDeal</option>
                                                            </select>
                                                            <div class="invalid-feedback"><?php echo $errors['PaymentMethod'] ?? ''; ?></div>
                                                        </div>
                                                        <div class="col-md-12" style="margin-top: 10px">
                                                            <textarea id="PaymentInstruction" name="PaymentInstruction" class="md-textarea form-control" placeholder="Overige betaal informatie" rows="8"><?php echo $_POST['PaymentInstruction'] ?? "" ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-left tab-pane fade show" id="shipping" role="tabpanel" aria-labelledby="pills-description-tab">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="ShippingCosts">Verzendkosten*</label>
                                                            <input type="number" step="0.1" value="<?php echo $_POST['ShippingCosts'] ?? "0" ?>" name="ShippingCosts" class="form-control <?php echo isset($errors['ShippingCosts']) ? 'is-invalid' : ''; ?>" required>
                                                            <div class="invalid-feedback"><?php echo $errors['ShippingCosts'] ?? ''; ?></div>
                                                        </div>
                                                        <div class="col-md-12" style="margin-top: 10px">
                                                            <textarea id="ShippingInstructions" name="ShippingInstructions" class="md-textarea form-control" placeholder="Overige verzend informatie" rows="8"><?php echo $_POST['ShippingInstructions'] ?? "" ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary text-white">Verstuur</button>
                </form>
            </div>
        </div>
    </div>
</div>