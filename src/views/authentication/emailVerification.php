<?php 

session_start();
if(empty($_SESSION['emailverification'])){
    header("Location: /emailregistreren");
}

require_once('controllers/UserController.php');

if(isset($_POST['submit'])){
    UserController::emailVerification($_POST["code"]);
}

?>

<div class="card text-center">
    <div class="card-body">

        <h5 class="card-title">Email verificatie</h5>
        <h6 class="card-subtitle mb-2 text-muted">Vul de code van de bevestigingsmail in.</h6>

        <form method="POST">

            <div class="form-group">
                <input type="text" name="code" class="form-control" placeholder="123456">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Verstuur</button>
        </form>
    </div>
</div>