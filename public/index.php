<?php

use App\core\Application;

// include the autoload file
include __DIR__ . '/../vendor/autoload.php';

// Start the application
$app = new Application();
$app->run();