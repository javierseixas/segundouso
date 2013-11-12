<?php

namespace SegundoUso\AdBundle\Event;


use SegundoUso\AdBundle\Model\AdInterface;
use Symfony\Component\EventDispatcher\Event;

class AdEvent extends Event
{
    /**
     * @var \SegundoUso\AdBundle\Model\AdInterface
     */
    protected $ad;

    public function __construct(AdInterface $ad)
    {
        $this->ad = $ad;
    }

    /**
     * @return AdInterface
     */
    public function getAd()
    {
        return $this->ad;
    }

}