<?php
require_once('controllers/SellerController.php');

$errors = [];

if (isset($_POST['delete'])) {
    SellerController::resetCode();
}
if (isset($_POST['submit'])) {
    $errors = SellerController::checkCode($_POST["code"]);
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card text-center">
            <div class="card-body">
                <form method="POST">
                    <h5 class="card-title">
                        Adres verificatie
                        <button class="btn btn-secondary float-right" type="submit" name="delete">Herstellen</button>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">Voer de code in die genoteerd staat in de ontvangen brief.</h6>
                </form>
                <form method="POST">

                    <div class="form-group">
                        <input type="text" value="<?php echo $_POST['code'] ?? "" ?>" name="code" class="form-control <?php echo isset($errors['code']) ? 'is-invalid' : ''; ?>" placeholder="123456" required>
                        <div class="invalid-feedback"><?php echo $errors['code'] ?? ''; ?></div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary text-white">Verstuur</button>
                </form>
            </div>
        </div>
    </div>
</div>