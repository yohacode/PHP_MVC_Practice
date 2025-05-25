<?php

namespace App\bootstrap;

class ErrorHandler
{
    use \App\traits\ErrorPagesHelper;
    /**
     * Register the error and exception handlers.
     * This method should be called at the beginning of your application.
     */
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
        // exit();
    }

    public static function handleError(int $errno, string $errstr, string $errfile, int $errline): void
    {
        // Convert PHP errors to ErrorException
        throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
    }

    public static function handleException(\Throwable $exception): void
    {
        // http_response_code(500);
        error_log($exception); // You can also log to a file here
        // log to a file
        if (!is_dir(__DIR__ . '/../../storage/logs')) {
            mkdir(__DIR__ . '/../../storage/logs', 0777, true);
        }
        file_put_contents(__DIR__ . '/../../storage/logs/error.log', (string) $exception . PHP_EOL, FILE_APPEND);
        self::renderErrorViews($exception);
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

    protected static function renderErrorViews(\Throwable $exception): void
    {
        $exceptions = $exception;
        // render a custom error page based on the exception type
        if ($exception instanceof \App\exceptions\PageNotFound) {
            self::render404Page();
        } elseif ($exception instanceof \App\exceptions\UnauthorizedException) {
            self::render401Page();
        } elseif ($exception instanceof \App\exceptions\ForbiddenException) {
            self::render403Page();
        }else {
            // dd($exceptions);
            self::render500Page();
        }
    }


}
