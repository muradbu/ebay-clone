<?php

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

switch ($request_uri[0]) {
    case '/':
        require 'views/index.php';
        break;
    case '/users':
        require 'views/authentication/login.php';
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        require '../views/404.php';
        break;
}
