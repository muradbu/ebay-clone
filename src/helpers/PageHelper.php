<?php

function isAuthenticated($url){
    return isset($_SESSION['authenticated']) ? $url : redirect("/inloggen");
}