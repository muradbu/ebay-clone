<?php

//URL guide: /test/:id/debug/:id

$request_uri = preg_replace("/\d/", ":id", $_SERVER['REQUEST_URI']);

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

        //ajax calls
    case '/api/getPopular':
        require_once 'controllers/ProductController.php';
        echo ProductController::getPopularWithoutIds(1, $_GET['ajaxId']);
        break;
    case '/api/getTop':
        require_once 'controllers/ProductController.php';
        echo ProductController::getTopWithoutIds(1, $_GET['ajaxId']);
        break;
    case '/api/getNewest':
        require_once 'controllers/ProductController.php';
        echo ProductController::getNewestWithoutIds(1, $_GET['ajaxId']);
        break;
    case '/api/product':
        require_once 'controllers/ProductController.php';
        echo ProductController::getPrices($_GET['ids']);
        break;
    case '/api/product/track':
        require_once 'controllers/ProductController.php';
        echo ProductController::getTracked($_GET['ids']);
        break;

    default:
        require '../views/404.php';
        break;
}
