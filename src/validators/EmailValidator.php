<?php

require_once('controllers/UserController.php');

class EmailValidator
{

    /**
     *
     * Validate a emailadress
     *
     * @param string $email The email to validate.
     *
     * @return array Return the error message or true
     *
     */
    public static function validate($email)
    {
        $errors = [];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Het opgegeven email is incorrect.";
        }

        if (count(UserController::get($email, "email")) > 0) {
            $errors["email"] = "Het opgegeven email bestaat al.";
        }

        return $errors;
    }
}
