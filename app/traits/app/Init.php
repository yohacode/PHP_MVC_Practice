<?php 
declare(strict_types=1);

namespace App\traits\app;

// check if BASE_PATH is already defined to avoid redefinition
if (!defined('BASE_PATH')) {
    // Define BASE_PATH relative to this file
    define('BASE_PATH', __DIR__ . '/../..');
}
// define('BASE_PATH', __DIR__ . '/../..'); // Define BASE_PATH relative to this file




// Import necessary classes
use App\core\Router;
use App\bootstrap\ErrorHandler;

trait Init
{
    // load parent constructor
    /**
     * Application constructor.
     * Initializes the application by registering error handlers and loading configurations.
     */
    public function __construct()
    {
        // Initialize the application
        ErrorHandler::register();
        // Call the init method to load environment variables, configurations, and routes
        $this->init();
    }
    /**
     * Initializes the application by registering error handlers,
     * loading environment variables, configuration files, and routes.
     */
    public function init(): void
    {
        // Error handling
        \App\bootstrap\ErrorHandler::register();
        
        // Load environment variables
        load_env(BASE_PATH);
        
        // Load configuration files 
        config(BASE_PATH. '/config/app.php');
        
        // Load routes
        try {
            \App\core\LoadRouters::loadRouter(BASE_PATH. '/routes/www.php');
        } catch (\Exception $e) {
            echo "Error loading routes: " . $e->getMessage();
        }
    }

    /**
     * Handles the request by dispatching it to the appropriate controller and action.
     */
    public function handleRequest(): void
    {
        Router::run();
    }
}