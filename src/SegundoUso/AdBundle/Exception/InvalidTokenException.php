<?php

namespace SegundoUso\AdBundle\Exception;


class InvalidTokenException extends \RuntimeException
{
    public function __construct($message = 'Access Denied', \Exception $previous = null)
    {
        parent::__construct($message, 403, $previous);
    }
}
