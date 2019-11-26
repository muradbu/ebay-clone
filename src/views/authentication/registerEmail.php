<?php 

require_once('controllers/UserController.php');

if(isset($_POST['submit'])){
    UserController::sendEmailVerification($_POST["email"]);
}

?>

<div class="card text-center">
    <div class="card-body">

        <h5 class="card-title">Registreren</h5>
        <h6 class="card-subtitle mb-2 text-muted">Vul uw email in om een bevestigingsmail te ontvangen</h6>

        <form method="POST">

            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="voorbeeld@email.com">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Verstuur</button>
        </form>
    </div>
</div>