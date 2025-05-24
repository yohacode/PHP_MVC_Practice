<?php

use App\core\Application;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// include the autoload file
include __DIR__ . '/../vendor/autoload.php';
// include the helper file 
// Start the application
$app = new Application();
$app->run();

// dd($_ENV['APP_NAME'], "env");