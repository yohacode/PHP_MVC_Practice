<?php

namespace App\exceptions;

use Exception;

class LoadFileException extends Exception
{
    protected $message = 'Error loading file';
    protected $code = 500;

    public function getErrorMessage()
    {
        return $this->message;
    }
}