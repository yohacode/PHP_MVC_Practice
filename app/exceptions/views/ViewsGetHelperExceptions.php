<?php

namespace App\exceptions\views;
use \Exception;

class ViewsGetHelperExceptions extends Exception
{
    /**
     * Custom exception for handling view-related errors.
     *
     * This class extends the base Exception class to provide specific error messages
     * related to view operations such as file not found, configuration issues, etc.
     *
     * @package App\exceptions\views
     */
    public $code = 500; // HTTP 500 Internal Server Error
    public $message = 'An error occurred while processing the view.';
    // public $file = __FILE__;
    public $trace = [];
    public $previous = null;
    public $traceAsString = '';
    public $string = '';
    public $severity = E_ERROR;
    public $errorCode = 0;
    public $errorFile = '';
    public $errorLine = 0;
    public $errorMessage = '';
    public $errorContext = [];
    public $errorType = 'ViewError';
    public $errorDetails = [];
    public $errorData = [];
    public $errorCodeName = 'ViewGetHelperException';
    public $errorCodeDescription = 'An error occurred while retrieving the view.';
    public $errorCodeCategory = 'View';
    public $errorCodeSeverity = 'Critical';
    public $errorCodeSolution = 'Check the view file path and ensure it exists.';
    
    public static function configFileNotFound(string $config): self
    {
        return new self("Configuration file not found: " . $config);
    }

    public static function languageFileNotFound(string $language): self
    {
        return new self("Language file not found: " . $language);
    }

    public static function logFileNotFound(string $log): self
    {
        return new self("Log file not found: " . $log);
    }

    public static function cacheFileNotFound(string $cache): self
    {
        return new self("Cache file not found: " . $cache);
    }

    public static function viewFileNotFound(string $view): self
    {
        return new self("View file not found: " . $view);
    }
}
