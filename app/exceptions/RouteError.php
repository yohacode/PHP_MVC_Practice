<?php

namespace App\exceptions;
use Exception;

class RouteError extends Exception
{
    protected $message = 'Route not found';
    protected $code = 404;

    public function __construct($message = null, $code = null)
    {
        if ($message) {
            $this->message = $message;
        }
        if ($code) {
            $this->code = $code;
        }
        parent::__construct($this->message, $this->code);
    }

    public function render()
    {
        // Render a custom error page or return a JSON response
        http_response_code($this->code);
        echo "<h1>{$this->message}</h1>";
        exit;
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function getErrorCode()
    {
        return $this->code;
    }

    public function getErrorMessage()
    {
        return $this->message;
    }

    public function getErrorFile()
    {
        return $this->getFile();
    }

    public function getErrorLine()
    {
        return $this->getLine();
    }

    public function getErrorTrace()
    {
        return $this->getTraceAsString();
    }

    public function getErrorTraceAsString()
    {
        return $this->getTraceAsString();
    }

    public function getErrorPrevious()
    {
        return $this->getPrevious();
    }

    public function getErrorPreviousAsString()
    {
        return $this->getPrevious() ? $this->getPrevious()->__toString() : null;
    }

    public function getErrorFileName()
    {
        return $this->getFile();
    }

    public function getErrorLineNumber()
    {
        return $this->getLine();
    }

    public function getErrorTraceAsArray()
    {
        return $this->getTrace();
    }

    public function getErrorTraceAsStringArray()
    {
        return explode("\n", $this->getTraceAsString());
    }

    public function getErrorPreviousAsArray()
    {
        return $this->getPrevious() ? $this->getPrevious()->getTrace() : null;
    }

    public function getErrorPreviousAsStringArray()
    {
        return $this->getPrevious() ? explode("\n", $this->getPrevious()->getTraceAsString()) : null;
    }

    public function getErrorPreviousFileName()
    {
        return $this->getPrevious() ? $this->getPrevious()->getFile() : null;
    }

}