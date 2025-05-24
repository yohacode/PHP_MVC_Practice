<?php

namespace App\core;

use App\interface\LoadRouterInterface;
use App\exceptions\LoadRouterException;

class LoadRouters implements LoadRouterInterface
{
    public static function loadRouter($filePath)
    {
        if (!file_exists($filePath)) {
            throw new LoadRouterException("File not found: $filePath");
        }

        require $filePath; // Register routes
    }
}
