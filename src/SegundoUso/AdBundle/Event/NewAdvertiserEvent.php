<?php

namespace SegundoUso\AdBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * @deprecated
 */
class NewAdvertiserEvent extends Event
{
    /**
     * @var string
     */
    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}