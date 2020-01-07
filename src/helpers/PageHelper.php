<?php

function isAuthenticated($url, $isSeller = false){
    if(isset($_SESSION['authenticated'])) {
        if($isSeller) {
            return $_SESSION['authenticated']['Seller'] ? $url : redirect("/registrerenverkoper");
        } else {
            return $url;
        }
    } else {
        redirect("/inloggen");
    }
}