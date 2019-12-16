<?php

function isAuthencated($url){
    return isset($_SESSION['authenticated']) ? $url : redirect("/inloggen");
}