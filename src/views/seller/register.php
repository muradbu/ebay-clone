<?php
require_once('controllers/SellerController.php');
$errors = [];
if (isset($_POST['submit']))
    $errors = SellerController::post($_POST);

?>

<form method="post">
    <div class="row mt-3">
        <div class="card col-12 p-3">
            <h3>Selecteer verificatie methode:</h3>
            <div class="form-check">                
                <input class="form-check-input" type="radio" name="verification" id="creditcard" value="creditcard" checked>
                <label class="form-check-label" for="creditcard">Creditcard</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="verification" id="mail" value="mail">
                <label class="form-check-label" for="mail">
                    Post
                </label>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        
        <div class="card col-12 p-3" id="creditcard-form">
            <h3>Creditcard:</h3>
              <div class="form-group row">
    <label for="Creditcardnummer" class="col-sm-2 col-form-label">Creditcardnummer:</label>
    <div class="col-sm-10">
    <input placeholder="3216 5845 8945 747" class="form-control <?php echo isset($errors['CreditcardNumber']) ? 'is-invalid' : ''; ?>" type="number" name="CreditCardNumber" value="<?php echo $_POST['CreditcardNumber'] ?? "" ?>" checked>
    </div>
  </div>
            <button type="submit" name="submit" class="btn btn-primary text-white">Valideer</button>
        </div>
        <div class="card col-12 p-3" id="mail-form">
            <h3>Post:</h3>
            <div class="form-group row">
    <label for="Bank" class="col-sm-2 col-form-label">Bank:</label>
    <div class="col-sm-10">
    <input placeholder="ING" class="form-control <?php echo isset($errors['Bank']) ? 'is-invalid' : ''; ?>" type="text" name="Bank" value="<?php echo $_POST['Bank'] ?? "" ?>" checked>
    </div>
  </div>
  <div class="form-group row">
    <label for="Rekeningnummer" class="col-sm-2 col-form-label">Rekeningnummer:</label>
    <div class="col-sm-10">
    <input placeholder="NL91INGB0417164300" class="form-control <?php echo isset($errors['BankAccount']) ? 'is-invalid' : ''; ?>" type="text" name="BankAccount" value="<?php echo $_POST['BankAccount'] ?? "" ?>" checked>
    </div>
  </div>
            <button type="submit" name="submit" class="btn btn-primary text-white">Verstuur</button>
        </div>
    </div>
</form>