<?php

use App\core\LoadConfigs;


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

// include autoloader
require_once __DIR__ . '/../../vendor/autoload.php';

// app/helper/config.php
// Configuration file for the application 
// load configs using config helper function

/**
 * Load configuration file
 * 
 */

if (!function_exists('config')) {
    function config($key,$filePath='app')
    {
        // Load configuration, routes, etc.
        try {
            // dd(BASE_PATH);
            $filePath = BASE_PATH . '/app/config/' .$filePath.'.php';
            $config = LoadConfigs::loadConfig($filePath);
            // dd($config, $config['debug'], "config");
            return $config[$key] ?? null;
        } catch (\Exception $e) {
            echo "Error loading configuration: " . $e->getMessage();
            exit;
        }
    }
}