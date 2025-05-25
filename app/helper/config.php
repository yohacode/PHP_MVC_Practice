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