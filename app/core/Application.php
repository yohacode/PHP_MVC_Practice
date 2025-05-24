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
        Router::run();
    }
    
    public function handleRequest()
    {
        // Handle incoming requests
        echo "Handling request...\n";
        // Here you would typically parse the URL, determine the controller and action to call, etc.
        // For example:
        // $controller = new SomeController();
        // $controller->someAction();
    }

    public function sendResponse()
    {
        // Send response to the client
        echo "Sending response...\n";
    }
}