<?php

require_once('models/UserPhone.php');

class UserPhoneController
{
    /**
     *
     * Create a new Phonenumber
     *
     * @param array $data The data to create a new phonenumber.
     *
     */
    public static function post($data)
    {
        try {
            $userPhone = new UserPhone();

            foreach (array_keys($data) as $value) {
                if (property_exists('UserPhone', $value))
                    $userPhone->$value = $data[$value];
            }

            $userPhone->post();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
