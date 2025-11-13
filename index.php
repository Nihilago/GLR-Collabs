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
$router->addRoute('GET', '/collabs', 'HomeController', 'index');
$router->addRoute('GET', '/collabs/', 'HomeController', 'index');
$router->addRoute('GET', '/collabs/login', 'AuthController', 'showLogin');
$router->addRoute('POST', '/collabs/login', 'AuthController', 'login');
$router->addRoute('GET', '/collabs/register', 'AuthController', 'showRegister');
$router->addRoute('POST', '/collabs/register', 'AuthController', 'register');
$router->addRoute('GET', '/collabs/logout', 'AuthController', 'logout');
$router->addRoute('GET', '/collabs/dashboard', 'DashboardController', 'index');

// Dispatch the request
$router->dispatch();
?>
