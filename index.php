<?php

// Enable error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include required files
require_once 'utils/Router.php';
require_once 'utils/Session.php';

// Initialize session
Session::start();

// Create router instance
$router = new Router();

// Define routes
$router->addRoute('GET', '/', 'HomeController', 'index');

$router->addRoute('GET', '/login', 'AuthController', 'showLogin');
$router->addRoute('POST', '/login', 'AuthController', 'login');

$router->addRoute('GET', '/register', 'AuthController', 'showRegister');
$router->addRoute('POST', '/register', 'AuthController', 'register');

$router->addRoute('GET', '/logout', 'AuthController', 'logout');
$router->addRoute('GET', '/dashboard', 'DashboardController', 'index');

// Dispatch the request
$router->dispatch();
?>
