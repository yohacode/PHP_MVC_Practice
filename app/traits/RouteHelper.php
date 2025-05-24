<?php

namespace App\traits;

use App\exceptions\RouteError;
use App\bootstrap\ErrorHandler;


trait RouteHelper
{
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
        // Apply group prefix
        if (!empty($this->groupAttributes)) {
            $path = $this->groupAttributes['prefix'] . $path;
            $this->groupAttributes = [];
        }

        // Store route with parameters
        $parameters = $this->extractParameters($path);

        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback,
            'params' => $parameters,
        ];
    }

    
    public function dispatch($method, $requestPath)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            // Convert route path to regex
            $regex = preg_replace('/\{(\w+)\}/', '([^/]+)', $route['path']);
            $regex = '#^' . $regex . '$#';

            if (preg_match($regex, $requestPath, $matches)) {
                array_shift($matches); // Remove full match
                $params = array_keys($route['params']);
                $args = array_combine($params, $matches);

                // Call the callback with extracted params
                return call_user_func_array($route['callback'], $args);
            }
        }

        // Route not found
        throw new RouteError("Route not found: $method $requestPath", 404);
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
