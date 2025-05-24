<?php

// load autoloader
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';


/**
 * 
 * phpdotenv setup 
 */

if (!function_exists('load_env')) {
    // If the env function is already defined, do nothing
    function load_env($path = null)
    {
        if ($path === null) {
            $path = dirname(__DIR__, 2);
        }
        if (!defined('PHP_DOTENV_LOADED')) {
            $dotenv = Dotenv\Dotenv::createImmutable($path);
            $dotenv->load();
            define('PHP_DOTENV_LOADED', true);
        }
    }
}

/**
 * env config accessor
 */
if (!function_exists('env')) {
    function env($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}


if (!function_exists('view'))
{
    /**
     * Helper function to create a new View instance.
     *
     * @return \App\core\View
     */
    function view($name='',$argc = [])
    {
        $v = new \App\core\View();
        return $v->view($name, $argc);
    }
}


