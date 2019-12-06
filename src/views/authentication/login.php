<?php

require_once('controllers/UserController.php');

$errors = [];

if (isset($_POST['submit'])) {
    $errors = UserController::login($_POST["username"], $_POST["password"]);
}

?>

<div class="row justify-content-center">
    <div class="col-8">
        <div class="card text-center">
            <div class="card-body">

                <img width="100" src="<?php echo Config::ROOT_FOLDER ?>/img/logo.svg">
                <h5 class="card-title">Inloggen</h5>
                <h6 class="card-subtitle mb-2 text-muted">Vul de gegevens in om in te loggen.</h6>

                <form method="POST">

                    <div class="form-group">
                        <input type="text" value="<?php echo $_POST['username'] ?? "" ?>" name="code" class="form-control" placeholder="pietjansen" required>
                        <div class="invalid-feedback"><?php echo $errors['username'] ?? ''; ?></div>
                    </div>
                    <div class="form-group">
                        <input type="password" value="<?php echo $_POST['password'] ?? "" ?>" name="code" class="form-control" placeholder="*********" required>
                        <div class="invalid-feedback"><?php echo $errors['password'] ?? ''; ?></div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary text-white">Verstuur</button>
                    <div class="mt-3">
                        <a href="emailregistreren">Nog geen accout registreer hier</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>