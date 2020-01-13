<?php
$step = 1;

require_once('controllers/UserController.php');
require_once('controllers/QuestionController.php');
require_once('validators/EmailValidator.php');

if (isset($_POST["submit"])) {
    $errors = EmailValidator::validate($_POST["email"]);
    if (is_array($errors) && $errors["email"] == "Het opgegeven email bestaat al.") {
        $user = UserController::get($_POST["email"], "email");
        $question = QuestionController::get($user["QuestionId"])["Question"];
        $step = 2;
    }

    if ($step == 2)
        if (isset($_POST["newpassword"]) && isset($_POST["repeatnewpassword"]) && isset($_POST["answer"]))
            $errors = UserController::resetPassword($user["Username"], $_POST);
}
?>
<div class="row justify-content-center">
    <div class="col-8">
        <div class="card text-center">
            <div class="card-body">
                <h1 class="card-title">Wachtwoord vergeten?</h1>
                <?php if ($step == 1) { ?>
                    <p class="card-text">Vul hieronder uw email in.</p>
                    <form method="post">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <input type="email" name="email" class="form-control" placeholder="Emailadres" required>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <button type="submit" name="submit" class="btn-primary btn text-white">Volgende stap</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
                <?php if ($step == 2) { ?>
                    <p class="card-text">Vul hieronder het antwoord op de geheime vraag in en uw nieuwe wachtwoord.</p>
                    <form method="post">
                        <input type="hidden" name="email" class="form-control" value="<?php echo $_POST['email']; ?>">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 mt-2">
                                <label class="float-left" for="answer"><?php echo $question; ?>*</label>
                                <input type="text" value="<?php echo $_POST['answer'] ?? "" ?>" name="answer" class="form-control <?php echo isset($errors['answer']) ? 'is-invalid' : ''; ?>" required>
                                <div class="invalid-feedback"><?php echo $errors['answer'] ?? ''; ?></div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <label class="float-left" for="newpassword">Nieuw wachtwoord*</label>
                                <input type="password" value="<?php echo $_POST['newpassword'] ?? "" ?>" name="newpassword" class="form-control <?php echo isset($errors['newpassword']) ? 'is-invalid' : ''; ?>" required>
                                <div class="invalid-feedback"><?php echo $errors['newpassword'] ?? ''; ?></div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <label class="float-left" for="repeatnewpassword">Herhaal nieuw wachtwoord*</label>
                                <input type="password" value="<?php echo $_POST['repeatnewpassword'] ?? "" ?>" name="repeatnewpassword" class="form-control <?php echo isset($errors['repeatnewpassword']) ? 'is-invalid' : ''; ?>" required>
                                <div class="invalid-feedback"><?php echo $errors['repeatnewpassword'] ?? ''; ?></div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <button type="submit" name="submit" class="btn-primary btn text-white">Wijzig wachtwoord</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>