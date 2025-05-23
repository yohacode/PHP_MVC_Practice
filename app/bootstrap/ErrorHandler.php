<?php

namespace App\bootstrap;

class ErrorHandler
{
    public static function register(): void
    {
        // Enable full error reporting during development
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');

        // Register handlers
        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
        register_shutdown_function([self::class, 'handleShutdown']);
    }

    public static function handleError(int $errno, string $errstr, string $errfile, int $errline): void
    {
        // Convert PHP errors to ErrorException
        throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
    }

    public static function handleException(\Throwable $exception): void
    {
        http_response_code(500);
        error_log($exception); // You can also log to a file here
        // log to a file
        if (!is_dir(__DIR__ . '/../../storage/logs')) {
            mkdir(__DIR__ . '/../../storage/logs', 0777, true);
        }
        file_put_contents(__DIR__ . '/../../storage/logs/error.log', (string) $exception . PHP_EOL, FILE_APPEND);
        self::renderErrorPage($exception);
    }

    public static function handleShutdown(): void
    {
        $error = error_get_last();
        if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
            self::handleException(new \ErrorException(
                $error['message'],
                0,
                $error['type'],
                $error['file'],
                $error['line']
            ));
        }
    }

    protected static function renderErrorPage(\Throwable $exception): void
    {
        if (ob_get_length()) ob_clean(); // Clean any prior output

        http_response_code($exception->getCode() ?: 500); // Set the response code BEFORE sending output
        include __DIR__ . '/../../views/errors/general.php';
        $env = $_ENV['APP_ENV'] ?? getenv('APP_ENV') ?? 'production';
        $isDev = $env === 'development';

        if ($isDev) {
            // Developer-friendly error page
            require_once dirname(__DIR__, 2) . '/views/errors/general.php';
        } else {
            // Production-friendly error view
            require_once dirname(__DIR__, 2) . '/views/errors/500.php';
        }

        exit;
    }
}
