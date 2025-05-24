<?php

namespace App\core;

use App\bootstrap\ErrorHandler;
use App\exceptions\RouteError;
use App\interface\MethodsInterface;

class Router implements MethodsInterface
{
    use \App\traits\FromStatic;

    private $routes = [];
    private $groupAttributes = [];
    private $groupCallback = null;

    /**
     * Add a route to the router.
     * @var string $method The HTTP method (GET, POST, etc.)
     * @var string $path The path for the route.
     * @var callable $callback The callback function to handle the route.
     */
    public static function get($path, $callback)
    {
        self::me()->addRoute('GET', $path, $callback);
    }

    public static function post($path, $callback)
    {
        self::me()->addRoute('POST', $path, $callback);
    }

    public static function put($path, $callback)
    {
        self::me()->addRoute('PUT', $path, $callback);
    }

    public static function delete($path, $callback)
    {
        self::me()->addRoute('DELETE', $path, $callback);
    }

    public static function patch($path, $callback)
    {
        self::me()->addRoute('PATCH', $path, $callback);
    }

    public static function options($path, $callback)
    {
        self::me()->addRoute('OPTIONS', $path, $callback);
    }

    public static function head($path, $callback)
    {
        self::me()->addRoute('HEAD', $path, $callback);
    }

    public static function any($path, $callback)
    {
        self::me()->addRoute('ANY', $path, $callback);
    }

    

    

    public static function group($attributes, $callback)
    {
        self::me()->groupAttributes = $attributes;
        self::me()->groupCallback = $callback;
    }

    public static function redirect($from, $to, $status = 302)
    {
        self::me()->addRoute('REDIRECT', $from, function () use ($to, $status) {
            header("Location: $to", true, $status);
            exit;
        });
    }

    private function addRoute($method, $path, $callback)
    {
        // Check if the group attributes are set
        if (!empty($this->groupAttributes)) {
            $path = $this->groupAttributes['prefix'] . $path;
            $this->groupAttributes = [];
        }

        // Add the route to the routes array
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback,
        ];
    }

    public function dispatch($method, $path)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                call_user_func($route['callback']);
                return;
            }
        }

        http_response_code(404);
        // If no route is found, you can handle the 404 error here
        // Exception::handle(new \Exception("Route not found: $method $path"));
        // or you can include a custom 404 error page
        // echo '404 Not Found';
        throw new RouteError("Route not found: $method $path", 404);
    }

    // get routes
    public static function getRoutes()
    {
        return self::me()->routes;
    }

    public static function run()
    {
        // Get the current request method and path
        $method = $_SERVER['REQUEST_METHOD'];
        // Parse the URL to get the path with query string array
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Remove the query string from the path
        $path = strtok($path, '?');
        // Dispatch the request to the appropriate route

        // 
        try {
            self::me()->dispatch($method, $path);
        } catch (\App\exceptions\RouteError $e) {
            // Handle the exception (e.g., log it, show a custom error page, etc.)
            http_response_code(400);
            // Log the error (optional)
            error_log($e->getMessage());
            // Show custom error page
            ErrorHandler::handleException($e);
            
        }
        // self::me()->dispatch($method, $path);
    }

    // get query string array from current request
    public static function getQueryString()
    {
        // Parse the URL to get the query string
        $queryString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        // Parse the query string into an associative array
        parse_str($queryString, $queryArray);
        return $queryArray;
    }

    public function __call($name, $arguments)
    {
        // Handle dynamic method calls for HTTP methods
        if (in_array(strtoupper($name), ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS', 'HEAD'])) {
            return $this->addRoute(strtoupper($name), ...$arguments);
        }

        throw new \BadMethodCallException("Method $name does not exist.");
    }

}