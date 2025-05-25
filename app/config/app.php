<?php


// check if BASE_PATH is already defined to avoid redefinition
if (!defined('BASE_PATH')) {
    // Define BASE_PATH relative to this file
    define('BASE_PATH', __DIR__ . '/../..');
}

/**
 * Configuration file for the application
 *
 * This file contains the configuration settings for the application,
 * including database connection details, application name, version,
 * and other settings.
 *
 * @package App\config
 */

// app/config/app.php
// Configuration file for the application
return [
    'app_name' => 'My Application',
    'version' => '1.0.0',
    'debug' => true,
    'base_url' => 'http://localhost:9000',
    'database' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'password@mysql',
        'dbname' => 'myapp_db'
    ],
    // Add more configuration settings as needed
    'log' => [
        'level' => 'debug',
        'file' => '/var/log/myapp.log'
    ],
    'cache' => [
        'enabled' => true,
        'path' => '/var/cache/myapp'
    ],
    'session' => [
        'lifetime' => 3600,
        'path' => '/var/session/myapp'
    ],
];