<?php

class NewUserValidator
{
    /**
     *
     * Validate a user
     *
     * @param arrat $data The data to validate.
     *
     * @return array Return the error message or true
     *
     */
    public static function validate($data)
    {
        $errors = [];
        if (!preg_match("/^[\w\d]{5,25}$/", $data['Username'])) {
            $errors['Username'] = "De opgegeven gebruiksersnaam is onjuist.";
        }
        if (!preg_match("/^(?=.*\d).{7,150}$/", $data['Password'])) {
            $errors['Password'] = "Het opgegeven wachtwoord is onjuist.";
        }
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/", $data['FirstName'])) {
            $errors['FirstName'] = "De opgegeven voornaam is onjuist.";
        }
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/", $data['LastName'])) {
            $errors['LastName'] = "De opgegeven achternaam is onjuist.";
        }
        if (!preg_match("/^[\w\d\s]{2,150}$/", $data['Address1'])) {
            $errors['Address1'] = "Het opgegeven adres is onjuist.";
        }
        if (!preg_match("/^[\w\d\s]{0,150}$/", $data['Address2'])) {
            $errors['Address2'] = "Het opgegeven adres is onjuist.";
        }
        if (!preg_match("/^[\w\d\s]{3,50}$/", $data['ZipCode'])) {
            $errors['ZipCode'] = "De opgegeven postcode is onjuist.";
        }
        if (!preg_match("/^[\w\d\s]{3,50}$/", $data['CityName'])) {
            $errors['CityName'] = "De opgegeven woonplaats is onjuist.";
        }
        list($yyyy, $mm, $dd) =  explode('-', $data['DateOfBirth']);
        if (!checkdate($mm, $dd, $yyyy)) {
            $errors['DateOfBirth'] = "De opgegeven geboortedatum is onjuist.";
        }
        if (!preg_match("/^[\w\s]{3,150}$/", $data['Country'])) {
            $errors['Country'] = "Het opgegeven land is onjuist.";
        }
        if (!preg_match("/^[\d]{5,15}$/", $data['PhoneNumber'])) {
            $errors['PhoneNumber'] = "Het opgegeven telefoonnummer is onjuist.";
        }
        if (!preg_match("/^[\d]$/", $data['QuestionId'])) {
            $errors['QuestionId'] = "Kies een vraag.";
        }
        if (!preg_match("/^.{5,250}$/", $data['SafetyAnswer'])) {
            $errors['SafetyAnswer'] = "Het opgegeven antwoord is onjuist.";
        }

        return $errors;
    }
}
