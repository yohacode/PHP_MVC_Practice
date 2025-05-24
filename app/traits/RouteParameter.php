<?php

namespace App\traits;

trait RouteParameter
{
    /**
     * Extracts parameters from the route path.
     *
     * @param string $path The route path.
     * @return array An associative array of parameters.
     */
    public function extractParameters(string $path): array
    {
        preg_match_all('/\{(\w+)\}/', $path, $matches);
        return array_combine($matches[1], array_fill(0, count($matches[1]), null));
    }

    /**
     * Replaces parameters in the route path with their values.
     *
     * @param string $path The route path.
     * @param array $params An associative array of parameters and their values.
     * @return string The path with parameters replaced by their values.
     */
    public function replaceParameters(string $path, array $params): string
    {
        foreach ($params as $key => $value) {
            $path = str_replace('{' . $key . '}', $value, $path);
        }
        return $path;
    }
    /**
     * Checks if the route path contains parameters.
     *
     * @param string $path The route path.
     * @return bool True if the path contains parameters, false otherwise.
     */
    public function hasParameters(string $path): bool
    {
        return preg_match('/\{(\w+)\}/', $path) > 0;
    }
    /**
     * Gets the parameter names from the route path.
     *
     * @param string $path The route path.
     * @return array An array of parameter names.
     */
    public function getParameterNames(string $path): array
    {
        preg_match_all('/\{(\w+)\}/', $path, $matches);
        return $matches[1];
    }
    /**
     * Gets the parameter values from the route path.
     *
     * @param string $path The route path.
     * @param array $params An associative array of parameters and their values.
     * @return array An array of parameter values.
     */
    public function getParameterValues(string $path, array $params): array
    {
        $values = [];
        foreach ($this->getParameterNames($path) as $name) {
            if (isset($params[$name])) {
                $values[$name] = $params[$name];
            } else {
                $values[$name] = null; // Default value if not set
            }
        }
        return $values;
    }
    /**
     * Validates the parameters against the route path.
     *
     * @param string $path The route path.
     * @param array $params An associative array of parameters and their values.
     * @return bool True if the parameters match the path, false otherwise.
     */
    public function validateParameters(string $path, array $params): bool
    {
        $parameterNames = $this->getParameterNames($path);
        foreach ($parameterNames as $name) {
            if (!isset($params[$name])) {
                return false; // Missing parameter
            }
        }
        return true; // All parameters are present
    }
    /**
     * Converts the route path to a regex pattern.
     *
     * @param string $path The route path.
     * @return string The regex pattern.
     */
    public function pathToRegex(string $path): string
    {
        // Escape special characters and replace parameters with regex groups
        $escapedPath = preg_quote($path, '#');
        $regex = preg_replace('/\\\{(\w+)\\\}/', '([^/]+)', $escapedPath);
        return '#^' . $regex . '$#';
    }
    /**
     * Checks if the route path matches the regex pattern.
     *
     * @param string $path The route path.
     * @param string $regex The regex pattern.
     * @return bool True if the path matches the regex, false otherwise.
     */
    public function matchesRegex(string $path, string $regex): bool
    {
        // Convert the path to a regex pattern
        $pattern = $this->pathToRegex($path);
        // Check if the regex matches the path
        return preg_match($pattern, $regex) === 1;
    }
    /**
     * Extracts parameters from the route path using regex.
     *
     * @param string $path The route path.
     * @param string $regex The regex pattern.
     * @return array An associative array of parameters and their values.
     */
    public function extractParametersFromRegex(string $path, string $regex): array
    {
        // Convert the path to a regex pattern
        $pattern = $this->pathToRegex($path);
        // Check if the regex matches the path
        if (preg_match($pattern, $regex, $matches)) {
            array_shift($matches); // Remove full match
            $params = $this->getParameterNames($path);
            return array_combine($params, $matches);
        }
        return []; // No parameters found
    }
    /**
     * Converts the route path to a URL-friendly format.
     *
     * @param string $path The route path.
     * @return string The URL-friendly path.
     */
    public function toUrlFriendly(string $path): string
    {
        // Replace spaces with hyphens and convert to lowercase
        $urlFriendlyPath = str_replace(' ', '-', $path);
        $urlFriendlyPath = strtolower($urlFriendlyPath);
        // Remove any special characters
        $urlFriendlyPath = preg_replace('/[^a-z0-9\-]/', '', $urlFriendlyPath);
        return trim($urlFriendlyPath, '-'); // Trim leading/trailing hyphens
    }
}