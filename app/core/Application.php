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
        // Start the application
        // echo "Application is running...\n";
        // Handle incoming request
        $this->handleRequest();
        // Send response to the client
        $this->sendResponse();
        // Close the application
        // echo "Application is closing...\n";
        // Cleanup resources
        // ...
        // Exit the application
        exit;
    }
    
    public function handleRequest()
    {
        //  Handle incoming request
        // echo "Handling request...\n";
        // Dispatch the request to the router
        Router::run();
    }

    public function sendResponse()
    {
        // Send response to the client
        // echo "Sending response...\n";
    }
}