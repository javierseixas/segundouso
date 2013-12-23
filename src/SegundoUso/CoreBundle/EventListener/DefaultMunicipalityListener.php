<?php

namespace SegundoUso\CoreBundle\EventListener;

use SegundoUso\LocationBundle\Model\MunicipalityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\KernelEvents;

class DefaultMunicipalityListener
{
    private $om;

    public function __construct(MunicipalityManagerInterface $om)
    {
        $this->om = $om;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
            // don't do anything if it's not the master request
            return;
        }

        $session = $event->getRequest()->getSession();

        if (!$session->has('currentMunicipality')) {
            $session->set('currentMunicipality', 'barcelona');
        }
    }

}