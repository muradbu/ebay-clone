<?php

class EmailValidator{
    public static function validate($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return array(
                "email" => "Het opgegeven email is incorrect."
            );
          }    

        return true;
    }
}

?>