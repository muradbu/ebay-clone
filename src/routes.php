<?php

//URL guide: /test/:id/debug/:id

$request_uri = preg_replace("/\d/", ":id", $_SERVER['REQUEST_URI']);
$request_uri = preg_replace("/\?.{0,}/","",$request_uri);

switch ($request_uri) {
    case '/':
        require 'views/home/home.php';
        break;
    case '/inloggen':
        require 'views/authentication/login.php';
        break;
    case '/uitloggen':
        require_once 'controllers/UserController.php';

        UserController::logout();

        break;
    case '/rubrieken':
        require 'views/category/overview.php';
        break;
    case '/registreren':
        require 'views/authentication/register.php';
        break;
    case '/emailregistreren':
        require 'views/authentication/registerEmail.php';
        break;
    case '/emailbevestigen':
        require 'views/authentication/emailVerification.php';
        break;
    default:
        require '../views/404.php';
        break;
}
