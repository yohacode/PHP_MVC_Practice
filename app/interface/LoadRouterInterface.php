<?php

namespace App\interface;

use App\exceptions\LoadRouterException;

interface LoadRouterInterface
{
    /**
     * Load the router file.
     *
     * @param string $filePath The path to the router file.
     * @return mixed The loaded router.
     * @throws LoadRouterException If the router file cannot be loaded.
     */
    public static function loadRouter($filePath);
}