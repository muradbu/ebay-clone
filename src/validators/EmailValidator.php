<?php

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
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return array(
                "email" => "Het opgegeven email is incorrect."
            );
        }

        return true;
    }
}
