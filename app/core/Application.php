<?php

namespace App\core;

use Exception;
use App\bootstrap\ErrorHandler;

class Application
{
    public function __construct()
    {
        // Initialize the application
        $this->init();
    }

    private function init()
    {
        // Error handling
        ErrorHandler::register();
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

    public function run()
    {
        $this->handleRequest();
        $this->sendResponse();
        exit;
    }
    
    public function handleRequest()
    {
        Router::run();
    }

    public function sendResponse()
    {
    }
}