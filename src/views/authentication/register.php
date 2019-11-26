<?php 

session_start();

if(!$_SESSION['emailverification']['verified']){
    header("Location: /emailregistreren");
}

require_once('controllers/UserController.php');
require_once('controllers/QuestionController.php');

$questions = QuestionController::query();

if(isset($_POST['submit'])){
    $_POST['email'] = $_SESSION['emailverification']['email'];
    UserController::post($_POST);
}

?>

<div class="card text-center">
    <div class="card-body">

        <h5 class="card-title">Persoonlijke gegevens</h5>
        <h6 class="card-subtitle mb-2 text-muted">Vul uw persoonlijke gegevens in om de registratie te voltooien.</h6>
      
        <form method="POST">

            <div class="form-group">
                <div class="container text-left">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <label for="username">Gebruikersnaam*</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <label for="password">Wachtwoord*</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <label for="firstname">Voornaam*</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <label for="lastname">Achternaam*</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <label for="address1">Adres*</label>
                            <input type="text" name="adres1" id="adres1" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <label for="address2">Adres 2</label>
                            <input type="text" name="address2" id="address2" class="form-control">
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <label for="zipcode">Postcode*</label>
                            <input type="text" name="zipcode" id="zipcode" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <label for="cityname">Woonplaats*</label>
                            <input type="text" name="cityname" id="cityname" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <label for="dateofbirth">Geboortedatum*</label>
                            <input type="date" name="dateofbirth" id="dateofbirth" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <label for="country">Land*</label>
                            <input type="text" name="country" id="country" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <label for="phonenumber">Telefoonnummer*</label>
                            <input type="text" name="phonenumber" id="phonenumber" class="form-control" required>
                            <small id="phonenumberHelp" class="form-text text-muted">Meer telefoonnummers toevoegen? Ga naar gebruikersintellingen.</small>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6"> 
                            <label for="questionid">Veiligheidsvraag*</label>
                            <select class="form-control" id="questionId" required>
                                <?php  
                                    if(!empty($questions)){
                                        foreach ($questions as $key=>$value) {
                                            echo "<option name='questionId' value=".$value['questionId'].">".$value['question']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12"> 
                            <label for="safetyanswer">Antwoord*</label>
                            <input type="text" name="safetyanswer" id="safetyanswer" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Verstuur</button>
        </form>
    </div>
</div>