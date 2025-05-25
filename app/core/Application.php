<?php declare(strict_types=1);

namespace App\core;


class Application
{
    use \App\traits\app\Init;

    public function run(): void
    {
        $this->handleRequest();
    }
    

    
}