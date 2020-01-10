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
        $user = UserController::getByEmail($data["email"]);

        if (!preg_match("/^(?=.*\d).{7,150}$/", $data['newpassword'])) {
            $errors['newpassword'] = "Het opgegeven wachtwoord is onjuist en moet minimaal 7 characters bevatten en max 150 characters.";
        }

        if (!preg_match("/^(?=.*\d).{7,150}$/", $data['repeatnewpassword'])) {
            $errors['repeatnewpassword'] = "Het opgegeven herhalings wachtwoord is onjuist en moet minimaal 7 characters bevatten en max 150 characters";
        }

        if (!preg_match("/^.{5,250}$/", $data['answer'])) {
            $errors['answer'] = "Het opgegeven antwoord is onjuist.";
        }
        if($data["newpassword"] != $data["repeatnewpassword"]){
            $errors['repeatnewpassword'] = "Wachtwoorden komen niet overeen.";
            $errors['newpassword'] = "Wachtwoorden komen niet overeen.";
        }

        if(trim($data["answer"]) != trim($user['SafetyAnswer'])){
            $errors['answer'] = "Antwoord komt niet overeen.";
        }

        if (count($errors) > 0){
            return $errors;
        }else{
            return false;
        }
    }
}
