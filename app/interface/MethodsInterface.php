<?php

namespace App\interface;

interface MethodsInterface
{
    // Define the methods for the router

    public static function get($path, $callback);
    public static function post($path, $callback);
    public static function put($path, $callback);
    public static function delete($path, $callback);
    public static function patch($path, $callback);

    // Additional HTTP methods
    public static function options($path, $callback);
    public static function head($path, $callback);
    public static function any($path, $callback);
    public static function group($attributes, $callback);
    public static function redirect($from, $to, $status = 302);
}