<?php

namespace App\core;

use App\interface\LoadRouterInterface;
use App\exceptions\LoadRouterException;

class LoadRouters implements LoadRouterInterface
{
    public static function loadRouter($filePath)
    {
        // Load the router file
        if (file_exists($filePath)) 
        {
            return require $filePath;
        } else 
        {
            throw new LoadRouterException();
        }
    }
}