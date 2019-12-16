<?php

class NewUserValidator
{
    public static function validate($data)
    {

        $errors = [];

        if (!preg_match("/^[\w\d]{5,25}$/", $data['username'])) {
            $errors['username'] = "De opgegeven gebruiksersnaam is onjuist.";
        }
        if (!preg_match("/^(?=.*\d).{7,150}$/", $data['password'])) {
            $errors['password'] = "Het opgegeven wachtwoord is onjuist.";
        }
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/", $data['firstname'])) {
            $errors['firstname'] = "De opgegeven voornaam is onjuist.";
        }
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/", $data['lastname'])) {
            $errors['lastname'] = "De opgegeven achternaam is onjuist.";
        }
        if (!preg_match("/^[\w\d\s]{2,150}$/", $data['address1'])) {
            $errors['address1'] = "Het opgegeven adres is onjuist.";
        }
        if (!preg_match("/^[\w\d\s]{0,150}$/", $data['address2'])) {
            $errors['address2'] = "Het opgegeven adres is onjuist.";
        }
        if (!preg_match("/^[\w\d\s]{3,50}$/", $data['zipcode'])) {
            $errors['zipcode'] = "De opgegeven postcode is onjuist.";
        }
        if (!preg_match("/^[\w\d\s]{3,50}$/", $data['cityname'])) {
            $errors['cityname'] = "De opgegeven woonplaats is onjuist.";
        }
        list($yyyy, $mm, $dd) =  explode('-', $data['dateofbirth']);
        if (!checkdate($mm, $dd, $yyyy)) {
            $errors['dateofbirth'] = "De opgegeven geboortedatum is onjuist.";
        }
        if (!preg_match("/^[\w\s]{3,150}$/", $data['country'])) {
            $errors['country'] = "Het opgegeven land is onjuist.";
        }
        if (!preg_match("/^[\d]{5,15}$/", $data['phonenumber'])) {
            $errors['phonenumber'] = "Het opgegeven telefoonnummer is onjuist.";
        }
        if (!preg_match("/^[\d]$/", $data['questionId'])) {
            $errors['questionid'] = "Kies een vraag.";
        }
        if (!preg_match("/^.{5,250}$/", $data['safetyanswer'])) {
            $errors['safetyanswer'] = "Het opgegeven antwoord is onjuist.";
        }

        if (count($errors) > 0)
            return $errors;

        return true;
    }
}
