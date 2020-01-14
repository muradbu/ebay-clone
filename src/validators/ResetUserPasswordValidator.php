<?php

class ResetUserpasswordValidator
{
    /**
     *
     * Validate a user
     *
     * @param array $data The data to validate.
     *
     * @return array Return the error message or true
     *
     */
    public static function validate($data)
    {
        $errors = [];
        if (!preg_match("/^.{7,150}$/", $data['newpassword'])) {
            $errors['newpassword'] = "Het opgegeven wachtwoord moet minimaal 7 karakters bevatten.";
        }

        if ($data["newpassword"] != $data["repeatnewpassword"]) {
            $errors['repeatnewpassword'] = "Wachtwoord komt niet overeen.";
        }

        if (trim($data["answer"]) != trim(UserController::get($data["email"], "email")['SafetyAnswer'])) {
            $errors['answer'] = "Antwoord komt niet overeen.";
        }

        return $errors;
    }
}
