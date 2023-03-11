<?php

// Disallow type coercion

declare(strict_types = 1);

// Load classes

const BASE_PATH = __DIR__ . '/../src/';

spl_autoload_register(function ($class) {

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require BASE_PATH . "$class.php";
    
});

// Handle errors and exceptions

set_error_handler("core\ErrorHandler::handleError");
set_exception_handler("core\ErrorHandler::handleException");

// Get database credentials

$config = require(__DIR__ . '/../include/config.php');

// Split the request URL into an array

$parts = explode('/', $_SERVER["REQUEST_URI"]);

// Initialize database object

$database = new core\Database($config['database'], $config['user'][0], $config['password'][0]);

// Initialize router object

$mainController = new controller\Main($parts, $database);

$mainController->route();