<?php

namespace App\core;

use App\core\LoadConfigs;

class Application
{
    public function __construct()
    {
        // Initialize the application
        $this->init();
    }

    private function init()
    {
        // Load environment variables
        load_env(__DIR__. '/../../');

        // Load configuration files 
        config(__DIR__ . '/../config/app.php');
        // Load routes
        // dd(load_routes(__DIR__ . '/../../routes/www.php'), "routes");


        // This is where you would set up your application

    }

    public function run()
    {
        // Run the application
        // echo "Application is running.\n";
        load_routes(__DIR__ . '/../../routes/www.php');
        // Handle the request
        dd(Router::me()->getRoutes());
        Router::me()->run();
    }
    
    public function handleRequest()
    {
        // Handle incoming requests
        /**
         * * Here you would typically parse the request, route it to the appropriate controller,
         * * and return a response.
         * * * For example:
         * * $request = $_SERVER['REQUEST_URI'];
         * * if ($request === '/home') {
         * *     $this->homeController();
         * * } elseif ($request === '/about') {
         * *     $this->aboutController();
         * * } else {
         * *     $this->notFoundController();
         * * }
         */
    }

    public function sendResponse()
    {
        // Send response to the client
        echo "Sending response...\n";
    }
}