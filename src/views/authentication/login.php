<?php

require_once('controllers/UserController.php');

$errors = [];

if(isset($_POST['submit'])){
    $errors = UserController::login($_POST["username"], $_POST["password"]);
}

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 text-center">
                        <img width="100" src="<?php echo Config::ROOT_FOLDER ?>/img/logo.svg">
                        <h5 class="card-title">Inloggen</h5>
                    </div>
                    <form method="POST" >
                        <div class="form-group">
                            <label for="username">Gebruikersnaam</label>
                            <input id="username" value="<?php echo $_POST['username'] ?? "" ?>" name="username" class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" required>
                            <div class="invalid-feedback"><?php echo $errors['username'] ?? '' ; ?></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Wachtwoord</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Verstuur</button>
                    </form>
                    <div class="mt-3">
                        <a href="registreren">Nieuw? Registreer hier</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
