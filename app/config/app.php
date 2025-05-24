<?php

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