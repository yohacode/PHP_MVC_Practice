<?php

namespace App\traits;

trait FromStatic
{
    protected static $instance;

    public static function me()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    
}
