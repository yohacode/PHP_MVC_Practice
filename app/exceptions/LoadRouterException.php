<?php

namespace App\exceptions;

use Exception;

class LoadRouterException extends Exception
{
    protected $message = 'Error loading router';
    protected $code = 500;

    public function getErrorMessage()
    {
        return $this->message;
    }
}