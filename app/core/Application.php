<?php declare(strict_types=1);

namespace App\core;

use App\traits\app\Init;
use App\traits\FromStatic;

class Application
{
    use Init, FromStatic;

    public static function run(): void
    {
        self::me()->handleRequest();
    }
    

    
}