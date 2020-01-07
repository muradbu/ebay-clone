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
                                    <input type="text" value="<?php echo $_POST['Username'] ?? "" ?>" name="Username" class="form-control <?php echo isset($errors['Username']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['Username'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="password">Wachtwoord*</label>
                                    <input type="password" value="<?php echo $_POST['Password'] ?? "" ?>" name="Password" class="form-control <?php echo isset($errors['Password']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['Password'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="firstname">Voornaam*</label>
                                    <input type="text" value="<?php echo $_POST['FirstName'] ?? "" ?>" name="FirstName" class="form-control <?php echo isset($errors['FirstName']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['FirstName'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="lastname">Achternaam*</label>
                                    <input type="text" value="<?php echo $_POST['LastName'] ?? "" ?>" name="LastName" class="form-control <?php echo isset($errors['LastName']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['LastName'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="address1">Adres*</label>
                                    <input type="text" value="<?php echo $_POST['Address1'] ?? "" ?>" name="Address1" class="form-control <?php echo isset($errors['Address1']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['Address1'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="address2">Adres 2</label>
                                    <input type="text" value="<?php echo $_POST['Address2'] ?? "" ?>" name="Address2" class="form-control <?php echo isset($errors['Address2']) ? 'is-invalid' : ''; ?>">
                                    <div class="invalid-feedback"><?php echo $errors['Address2'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="zipcode">Postcode*</label>
                                    <input type="text" value="<?php echo $_POST['ZipCode'] ?? "" ?>" name="ZipCode" class="form-control <?php echo isset($errors['ZipCode']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['ZipCode'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="cityname">Woonplaats*</label>
                                    <input type="text" value="<?php echo $_POST['CityName'] ?? "" ?>" name="CityName" class="form-control <?php echo isset($errors['CityName']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['CityName'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="dateofbirth">Geboortedatum*</label>
                                    <input type="date" value="<?php echo $_POST['DateOfBirth'] ?? "" ?>" name="DateOfBirth" class="form-control <?php echo isset($errors['DateOfBirth']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['DateOfBirth'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="country">Land*</label>
                                    <input type="text" value="<?php echo $_POST['Country'] ?? "" ?>" name="Country" class="form-control <?php echo isset($errors['Country']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['Country'] ?? ''; ?></div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="phonenumber">Telefoonnummer*</label>
                                    <input type="number" value="<?php echo $_POST['PhoneNumber'] ?? "" ?>" name="PhoneNumber" class="form-control <?php echo isset($errors['PhoneNumber']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['PhoneNumber'] ?? ''; ?></div>
                                    <small id="phonenumberHelp" class="form-text text-muted">Meer telefoonnummers toevoegen? Ga naar de gebruikersintellingen.</small>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label for="questionid">Veiligheidsvraag*</label>
                                    <select value="<?php echo $_POST['QuestionId'] ?? "" ?>" class="form-control <?php echo isset($errors['QuestionId']) ? 'is-invalid' : ''; ?>" id="questionId" name="QuestionId" required>
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
                                    <input type="text" value="<?php echo $_POST['SafetyAnswer'] ?? "" ?>" name="SafetyAnswer" class="form-control <?php echo isset($errors['SafetyAnswer']) ? 'is-invalid' : ''; ?>" required>
                                    <div class="invalid-feedback"><?php echo $errors['SafetyAnswer'] ?? ''; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary text-white">Verstuur</button>
                    <div class="row justify-content-center">
                        <div class="col-9 mt-2">
                            <p>Door op registreren te klikken maak je een account aan en ga je akkoord met de <a href="#">algemene voorwaarden</a> en het <a href="#">privacystatement</a>.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
