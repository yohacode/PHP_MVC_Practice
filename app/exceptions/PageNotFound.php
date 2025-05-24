<?php

namespace App\exceptions;

use Exception;
class PageNotFound extends Exception
{
    protected $message = 'Page not found';
    protected $code = 404;

    public function __construct($message = null, $code = null, Exception $previous = null)
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