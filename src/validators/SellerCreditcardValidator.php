<?php

class SellerCreditcardValidator
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
    public static function validate($creditcardNumber)
    {
        if (!preg_match("/^\d{7,150}$/", $creditcardNumber))
            $errors['CreditcardNumber'] = "Het opgegeven nummer is onjuist.";

        return $errors;
    }
}
