<?php

class ContactValidator
{
    /**
     *
     * Validate the input text of the contact field
     *
     * @param int $message The message typed by the user.
     *
     * @return array Return the error message or true.
     * 
     */
    public static function validate($message)
    {
        if (empty($message)) {
            $errors['message'] = "Formulier mag niet leeg zijn.";
        } else if (strlen($message) > 250) {
            $errors['message'] = "Je bericht bevat meer dan 250 tekens.";
        }

        return $errors;
    }
}
