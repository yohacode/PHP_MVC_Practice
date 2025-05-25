<?php

namespace App\traits;


trait RouteMethodHelper
{
    
    public static function get($path, $callback)
    {
        self::me()->addRoute('GET', $path, $callback);
    }

  
    public static function post($path, $callback)
    {
        self::me()->addRoute('POST', $path, $callback);
    }

    
    public static function put($path, $callback)
    {
        self::me()->addRoute('PUT', $path, $callback);
    }

    public static function delete($path, $callback)
    {
        self::me()->addRoute('DELETE', $path, $callback);
    }


    public static function patch($path, $callback)
    {
        self::me()->addRoute('PATCH', $path, $callback);
    }


    public static function options($path, $callback)
    {
        self::me()->addRoute('OPTIONS', $path, $callback);
    }

  
    public static function head($path, $callback)
    {
        self::me()->addRoute('HEAD', $path, $callback);
    }


    public static function any($path, $callback)

    {
        self::me()->addRoute('ANY', $path, $callback);
    }

    
}