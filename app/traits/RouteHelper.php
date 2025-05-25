<?php

namespace App\traits;

use App\bootstrap\ErrorHandler;

trait RouteHelper
{
    public static function group($attributes, $callback)
    {
        self::me()->groupAttributes = $attributes;
        self::me()->groupCallback = $callback;
    }

    public static function redirect($from, $to, int $status = 302)
    {
        self::me()->addRoute('REDIRECT', $from, function () use ($to, $status): void {
            header("Location: {$to}", true, $status);
            exit;
        });
    }

    private function addRoute(string $method, string $path, mixed $callback): void
    {
        // Apply group prefix
        if (!empty($this->groupAttributes)) {
            $prefix = isset($this->groupAttributes['prefix']) ? (string)$this->groupAttributes['prefix'] : '';
            $path = $prefix . $path;
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

    public function dispatch(string $method, string $requestPath): mixed
    {
        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            // Convert route path to regex
            $regex = preg_replace('/\{(\w+)\}/', '([^/]+)', (string)$route['path']);
            $regex = '#^' . $regex . '$#';

            if (preg_match($regex, $requestPath, $matches)) {
                array_shift($matches); // Remove full match
                $params = array_keys($route['params'] ?? []);
                $args = array_combine($params, $matches) ?: [];

                $callback = $route['callback'];

                if (is_string($callback)) {
                    if (strpos($callback, '@') === false) {
                        throw new \Exception("Invalid route callback format. Expected 'Controller@method'.");
                    }
                    [$controller, $methodName] = explode('@', $callback);
                    $controllerInstance = new $controller();
                    $callback = [$controllerInstance, $methodName];
                }

                if (is_array($callback)) {
                    if (is_string($callback[0]) && class_exists($callback[0])) {
                        $instance = new $callback[0];
                        $callback = [$instance, $callback[1]];
                        return call_user_func($callback, ...array_values($args));
                    } elseif (is_object($callback[0]) && method_exists($callback[0], (string)$callback[1])) {
                        $instance = $callback[0];
                    } else {
                        throw new \Exception("Invalid route callback.");
                    }
                }

                if (is_callable($callback)) {
                    return call_user_func($callback, ...array_values($args));
                }

                throw new \Exception("Invalid route callback.");
            }
        }

        throw new \App\exceptions\PageNotFound("No route found for {$method} {$requestPath}");
    }

    public static function getRoutes(): array
    {
        return self::me()->routes;
    }

    
    public static function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $path = is_string($path) ? strtok($path, '?') : '/';

        try {
            self::me()->dispatch($method, $path);
        } catch (\App\exceptions\RouteError $e) {
            http_response_code(400);
            error_log($e->getMessage());
            ErrorHandler::handleException($e);
        }
    }

    public static function getQueryString(): array
    {
        $queryString = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_QUERY);
        $queryArray = [];
        if ($queryString) {
            parse_str($queryString, $queryArray);
        }
        return $queryArray;
    }

    public function __call(string $name, array $arguments): mixed
    {
        if (in_array(strtoupper($name), ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS', 'HEAD'])) {
            return $this->addRoute(strtoupper($name), ...$arguments);
        }

        throw new \BadMethodCallException("Method {$name} does not exist.");
    }
}
