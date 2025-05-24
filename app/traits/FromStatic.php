<?php

namespace App\traits;

trait FromStatic
{
    /**
     * Static method to create a new instance of the class.
     *
     * @return static
     */
    public static function me()
    {
        return new static();
    }
}