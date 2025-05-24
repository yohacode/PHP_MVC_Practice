<?php


namespace App\exceptions;
use Exception;


class UnauthorizedException extends Exception
{
    protected $message = 'Unauthorized access';
    protected $code = 401;

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