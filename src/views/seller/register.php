<?php
require_once('controllers/SellerController.php');
if (isset($_POST['submit'])) {
    SellerController::post($_POST);
}
?>

<form method="post">
    <div class="row mt-3">
        <div class="card col-12 p-3">
            <h3>Selecteer verificatie methode:</h3>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="verification" id="creditcard" value="creditcard" checked>
                <label class="form-check-label" for="creditcard">
                    Creditcard
                </label>
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
            <div class="form-group">
                <label for="creditcardnumber">Creditcardnummer</label>
                <input type="text" class="form-control" id="creditcardnumber" name="creditcardnumber" placeholder="32435454654456">
            </div>
            <button type="submit" name="submit" class="btn btn-primary text-white">Valideer</button>
        </div>
        <div class="card col-12 p-3" id="mail-form">
            <h3>Post:</h3>
            <div class="form-group">
                <label for="bank">Bank</label>
                <input type="text" class="form-control" id="bank" name="bank" placeholder="ING">
            </div>
            <div class="form-group">
                <label for="bankaccount">Rekeningnummer</label>
                <input type="text" class="form-control" id="bankaccount" name="bankaccount" placeholder="NL91INGB0417164300">
            </div>
            <button type="submit" name="submit" class="btn btn-primary text-white">Verstuur</button>
        </div>
    </div>
</form>