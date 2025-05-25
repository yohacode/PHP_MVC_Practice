<?php

namespace App\traits;


// check if BASE_PATH is already defined to avoid redefinition
if (!defined('BASE_PATH')) {
    // Define BASE_PATH relative to this file
    define('BASE_PATH', __DIR__ . '/../..');
}
trait ErrorPagesHelper
{
    /**
     * Render a custom error page for any HTTP status code
     * 
     * @param int $code
     * @param string|null $message Optional message to pass to the view
     * @return void
     */
    public static function renderErrorPage(int $code, ?string $message = null): void
    {
        http_response_code($code);
        if (ob_get_length()) ob_clean();

        $viewPath = BASE_PATH . "/views/errors/{$code}.php";

        if (!file_exists($viewPath)) {
            // fallback to 500 or a generic error template
            $viewPath = BASE_PATH . '/views/errors/default.php';
        }

        // Optional: make $message available to the view
        if ($message) {
            $errorMessage = $message;
        }

        include $viewPath;
        exit;
    }

    // Optional aliases for common codes
    public static function render404Page(): void { self::renderErrorPage(404); }
    public static function render500Page(): void { self::renderErrorPage(500); }
    public static function render403Page(): void { self::renderErrorPage(403); }
    public static function render401Page(): void { self::renderErrorPage(401); }
}
