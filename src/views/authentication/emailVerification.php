<?php 

if(empty($_SESSION['emailverification'])){
    header("Location: /emailregistreren");
}

require_once('controllers/UserController.php');

$errors = [];

if(isset($_POST['submit'])){
    $errors = UserController::emailVerification($_POST["code"]);
}

?>

<div class="card text-center">
    <div class="card-body">

        <h5 class="card-title">Email verificatie</h5>
        <h6 class="card-subtitle mb-2 text-muted">Vul de code van de bevestigingsmail in.</h6>

        <form method="POST">

            <div class="form-group">
                <input type="text" value="<?php echo $_POST['code'] ?? "" ?>" name="code" class="form-control <?php echo isset($errors['code']) ? 'is-invalid' : ''; ?>" placeholder="123456" required>
                <div class="invalid-feedback"><?php echo $errors['code'] ?? '' ; ?></div>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Verstuur</button>
        </form>
    </div>
</div>