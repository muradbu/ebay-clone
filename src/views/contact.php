<?php

require_once('controllers/UserController.php');
require_once('validators/ContactValidator.php');
require_once('controllers/ProductController.php');

$errors = [];

if (isset($_POST['submit'])) {
    $product = Product::get(filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_NUMBER_INT), 'ProductId', 1);
    $errors = UserController::sendContactMail($product['Seller'], $_POST['message']);
}

?>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6 bg-white py-3">
        <form method="POST">
            <div class="form-group">
                <h2>Stel je vraag</h2>
                <textarea class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : ''; ?>" rows="4" cols="50" name="message" placeholder="Max toegestane tekens 250"></textarea>
                <div class="invalid-feedback"><?php echo $errors['message'] ?? ""; ?></div>
            </div>
            <button class="btn btn-primary text-white" type="submit" name="submit">Verstuur</button>
        </form>
    </div>
</div>