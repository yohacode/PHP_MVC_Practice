<?php

use App\core\Application;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
// Define the base path for the application
define('Microtime', microtime(true));

// include the autoload file
include __DIR__ . '/../vendor/autoload.php';

config('app_name', 'app');

// Start the application
$app = new Application();
$app->run();
