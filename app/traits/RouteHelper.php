<?php

namespace App\traits;

use App\exceptions\RouteError;
use App\bootstrap\ErrorHandler;

use function PHPSTORM_META\type;

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
                $params = array_keys($route['params'] ?? []);
                $args = array_combine($params, $matches) ?: [];

                $callback = $route['callback'];
                // var_dump($callback);

                // dd(call_user_func($callback, ...array_values($args)));

                // Handle different callback types
                if (is_string($callback)) {
                    // Assume format "Controller@method"
                    [$controller, $method] = explode('@', $callback);
                    $controllerInstance = new $controller();
                    $callback = [$controllerInstance, $method];
                }

                if (is_array($callback))
                {
                    // Check if the first element is a class instance or a class name
                    if (is_string($callback[0]) && class_exists($callback[0])) {
                        $instance = new $callback[0];
                        $callback = [$instance, $callback[1]];
                        // dd($instance->index(), $callback);
                        return call_user_func($callback);
                    } elseif (is_object($callback[0]) && method_exists($callback[0], $callback[1])) {
                        // Already an instance with method
                        $instance = $callback[0];
                    } else {
                        throw new \Exception("Invalid route callback.");
                    }
                }

                // if (is_array($callback) && is_object($callback[0]) && method_exists($callback[0], $callback[1])) {
                //     // return call_user_func_array($callback, array_values($args));
                //     $instance = new $callback[0];
                //     // dd($instance);
                // }

                if (is_callable($callback)) {
                    // dd('ds');
                    // dd($callback);
                    return call_user_func($callback);
                }

                // if (is_object($callback) && method_exists($callback, '__invoke')) {
                //     // return $callback(...array_values($args));
                //     return call_user_func($callback[0]);
                // }

                throw new \Exception("Invalid route callback.");
            }
        }

        throw new \Exception("No route found for $method $requestPath");
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
        // parse_str($queryString, $queryArray);
        // return $queryArray;
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
