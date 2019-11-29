<?php

class DataHelper {

    /**
     *
     * Convert input to safe output
     *
     * @param Data The data to convert to safe data
     *
     * @return Data Returns safe data
     *
     */
    public static function convertInput($data){
        if($data == null)
            return null;

        if(is_array($data)){
            return array_map('convertInput', $data);
        } else {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = strip_tags($data);
            return $data;
        }
    }
}

?>
