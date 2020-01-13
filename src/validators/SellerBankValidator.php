<?php

class SellerBankValidator
{
    /**
     *
     * Validate a Creditcard seller
     *
     * @param array $data The data to validate.
     *
     * @return array Return the error message or true
     *
     */
    public static function validate($data)
    {
        if (!preg_match("/^\w{7,150}$/", $data['Bank']))
            $errors['Bank'] = "De opgegeven banknaam is niet correct.";

        if (!preg_match("/^\w{7,150}$/", $data['BankAccount']))
            $errors['BankAccount'] = "De opgegeven rekeningnummer is niet correct.";

        return $errors;
    }
}
