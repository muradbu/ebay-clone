<?php 

require_once('controllers/UserController.php');

$errors = [];

if(isset($_POST['submit'])){
    $errors = UserController::sendEmailVerification($_POST["email"]);
}

?>

<div class="col-md-10 col-sm-10 col-lg-10">
    <div class="card text-center">
        <div class="card-body">

            <img width="100" src="<?php echo Config::ROOT_FOLDER ?>/img/logo.svg">
            <h5 class="card-title">Registreren</h5>
            <h6 class="card-subtitle mb-2 text-muted">Vul uw email in om een bevestigingsmail te ontvangen</h6>

            <form method="POST" >

                <div class="form-group">
                    <input type="email" value="<?php echo $_POST['email'] ?? "" ?>" name="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" placeholder="voorbeeld@email.com" required>
                    <div class="invalid-feedback"><?php echo $errors['email'] ?? '' ; ?></div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Verstuur</button>
            </form>
        </div>
    </div>
</div>