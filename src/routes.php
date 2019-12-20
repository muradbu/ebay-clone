<?php
require_once("helpers/PageHelper.php");
//URL guide: /test/:id/debug/:id

$request_uri = preg_replace("/[0-9]{1,}/", ":id", $_SERVER['REQUEST_URI']);
$request_uri = preg_replace("/\?.{0,}/", "", $request_uri);

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
    case '/gebruiker/biedingen/:id':
        require isAuthenticated('views/account/biddings.php');
        break;
    case '/veiling/:id':
        require 'views/product/auctionDetails.php';
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
    case '/api/getCurrentBiddings/:id':
        require_once 'controllers/BiddingController.php';
        echo json_encode(Bidding::query("3", "WHERE ProductId = " . filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_NUMBER_INT) . " ORDER BY BidAmount DESC"));
    default:
        require 'views/404.php';
        break;
}
