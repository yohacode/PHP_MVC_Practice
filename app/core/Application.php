<?php

namespace App\core;

use Exception;
use App\bootstrap\ErrorHandler;
use SebastianBergmann\Type\VoidType;

class Application
{
    public function __construct()
    {
        // Initialize the application
        // ErrorHandler::register();
        $this->init();
    }

    public function init(): void
    {
        // Error handling
        // Load environment variables
        load_env(__DIR__. '/../../');
        // Load configuration files 
        config(__DIR__ . '/../config/app.php');
        // Load routes
        try {
            LoadRouters::loadRouter(__DIR__ . '/../../routes/www.php');
        } catch (Exception $e) {
            echo "Error loading routes: " . $e->getMessage();
        }
    }

    public function run(): void
    {
        $this->handleRequest();
        // exit;
    }
    
    public function handleRequest(): void
    {
        Router::run();
    }

    
}