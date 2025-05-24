<?php

namespace App\traits;


trait RouteMethodHelper
{
    /**
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public static function get($path, $callback)
    {
        self::me()->addRoute('GET', $path, $callback);
    }

    /**
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public static function post($path, $callback)
    {
        self::me()->addRoute('POST', $path, $callback);
    }

    /**
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public static function put($path, $callback)
    {
        self::me()->addRoute('PUT', $path, $callback);
    }

    /**
     * @param string $path
     * @param callable $callback
     * @return void
     */

    public static function delete($path, $callback)
    {
        self::me()->addRoute('DELETE', $path, $callback);
    }

    /**
     * @param string $path
     * @param callable $callback
     * @return void
     */ 
    public static function patch($path, $callback)
    {
        self::me()->addRoute('PATCH', $path, $callback);
    }

    /**
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public static function options($path, $callback)
    {
        self::me()->addRoute('OPTIONS', $path, $callback);
    }

    /**
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public static function head($path, $callback)
    {
        self::me()->addRoute('HEAD', $path, $callback);
    }

    /**
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public static function any($path, $callback)

    {
        self::me()->addRoute('ANY', $path, $callback);
    }

    
}