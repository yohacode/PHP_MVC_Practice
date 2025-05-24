<?php

use App\core\LoadConfigs;

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
    function config($filePath)
    {
        // Load configuration, routes, etc.
        try {
            $config = LoadConfigs::loadConfig($filePath);
            // dd($config, $config['debug'], "config");
        } catch (\Exception $e) {
            echo "Error loading configuration: " . $e->getMessage();
            exit;
        }
    }
}