<?php

namespace App\core;

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

        // If no route is found, you can handle the 404 error here
        http_response_code(404);
        echo '404 Not Found';
    }

    // get routes
    public function getRoutes()
    {
        return $this->routes;
    }

    public function run()
    {
        // Get the current request method and path
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Dispatch the request to the appropriate route
        $this->dispatch($method, $path);
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