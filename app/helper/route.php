<?php

/**
 * Load routes
 */

use App\core\LoadRouters;
use App\exceptions\LoadRouterException;

if (!function_exists('load_routes'))
{
    // load routes from Router class
    function load_routes($filePath)
    {
        // Load routes
        try {
            // load router file
            LoadRouters::loadRouter($filePath);
            // dd($routes, "routes");
        } catch (LoadRouterException $e) {
            echo "Error loading routes: " . $e->getMessage();
            exit;
        }
    }
}