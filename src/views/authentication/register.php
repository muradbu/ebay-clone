<?php

if (!isset($_SESSION['emailverification']['verified'])) {
    redirect("emailregistreren");
}

require_once('controllers/UserController.php');
require_once('controllers/QuestionController.php');

$errors = [];
$questions = QuestionController::query();

if (isset($_POST['submit'])) {
    $_POST['email'] = $_SESSION['emailverification']['email'];
    $errors = UserController::post($_POST);
}

?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card text-center">
            <div class="card-body">

                <img width="100" src="<?php echo Config::ROOT_FOLDER ?>/img/logo.svg">
                <h5 class="card-title">Persoonlijke gegevens</h5>
                <h6 class="card-subtitle mb-2 text-muted">Vul uw persoonlijke gegevens in om de registratie te voltooien.</h6>

                <form method="POST">

                    <div class="form-group">
                        <div class="container text-left">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="username">Gebruikersnaam*</label>
                                    <input type="text" value="<?php echo $_POST['username'] ?? "" ?>" name="username" class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['username'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="password">Wachtwoord*</label>
                                    <input type="password" value="<?php echo $_POST['password'] ?? "" ?>" name="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['password'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="firstname">Voornaam*</label>
                                    <input type="text" value="<?php echo $_POST['firstname'] ?? "" ?>" name="firstname" class="form-control <?php echo isset($errors['firstname']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['firstname'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="lastname">Achternaam*</label>
                                    <input type="text" value="<?php echo $_POST['lastname'] ?? "" ?>" name="lastname" class="form-control <?php echo isset($errors['lastname']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['lastname'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="address1">Adres*</label>
                                    <input type="text" value="<?php echo $_POST['address1'] ?? "" ?>" name="address1" class="form-control <?php echo isset($errors['address1']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['address1'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="address2">Adres 2</label>
                                    <input type="text" value="<?php echo $_POST['address2'] ?? "" ?>" name="address2" class="form-control <?php echo isset($errors['address2']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['address2'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="zipcode">Postcode*</label>
                                    <input type="text" value="<?php echo $_POST['zipcode'] ?? "" ?>" name="zipcode" class="form-control <?php echo isset($errors['zipcode']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['zipcode'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="cityname">Woonplaats*</label>
                                    <input type="text" value="<?php echo $_POST['cityname'] ?? "" ?>" name="cityname" class="form-control <?php echo isset($errors['cityname']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['cityname'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="dateofbirth">Geboortedatum*</label>
                                    <input type="date" value="<?php echo $_POST['dateofbirth'] ?? "" ?>" name="dateofbirth" class="form-control <?php echo isset($errors['dateofbirth']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['dateofbirth'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="country">Land*</label>
                                    <input type="text" value="<?php echo $_POST['country'] ?? "" ?>" name="country" class="form-control <?php echo isset($errors['country']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['country'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="phonenumber">Telefoonnummer*</label>
                                    <input type="number" value="<?php echo $_POST['phonenumber'] ?? "" ?>" name="phonenumber" class="form-control <?php echo isset($errors['phonenumber']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['phonenumber'] ?? ''; ?></div>
                                    <small id="phonenumberHelp" class="form-text text-muted">Meer telefoonnummers toevoegen? Ga naar gebruikersintellingen.</small>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="questionid">Veiligheidsvraag*</label>
                                    <select value="<?php echo $_POST['questionId'] ?? "" ?>" class="form-control <?php echo isset($errors['questionId']) ? 'is-invalid' : ''; ?>" id="questionId" name="questionId" required>
                                        <?php
                                        if (!empty($questions)) {
                                            foreach ($questions as $key => $value) {
                                                echo "<option name='questionId' value=" . $value['QuestionId'] . ">" . $value['Question'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback"><?php echo $errors['questionId'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label for="safetyanswer">Antwoord*</label>
                                    <input type="text" value="<?php echo $_POST['safetyanswer'] ?? "" ?>" name="safetyanswer" class="form-control <?php echo isset($errors['safetyanswer']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['safetyanswer'] ?? ''; ?></div>

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