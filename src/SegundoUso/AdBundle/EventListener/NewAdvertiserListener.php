<?php

namespace SegundoUso\AdBundle\EventListener;


use SegundoUso\AdBundle\Event\NewAdvertiserEvent;
use SegundoUso\AdBundle\Model\AdvertiserManagerInterface;

/**
 * @deprecated
 */
class NewAdvertiserListener
{
    /**
     * @var \SegundoUso\AdBundle\Model\AdvertiserManagerInterface
     */
    private $am;

    /**
     * @param AdvertiserManagerInterface $am
     */
    public function __construct(AdvertiserManagerInterface $am)
    {
        $this->am = $am;
    }

    public function onNewEmailAdvertiser(NewAdvertiserEvent $event)
    {
        $email = $event->getEmail();

    }
}