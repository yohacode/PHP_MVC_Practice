<?php

namespace App\exceptions;
use Exception;

class ForbiddenException extends Exception
{
    protected $message = 'Forbidden access';
    protected $code = 403;

    public function __construct($message = null, $code = null, ?Exception $previous = null)
    {
        if ($message) {
            $this->message = $message;
        }
        if ($code) {
            $this->code = $code;
        }
        parent::__construct($this->message, $this->code, $previous);
    }
}