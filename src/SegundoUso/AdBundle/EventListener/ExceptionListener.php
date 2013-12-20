<?php

namespace SegundoUso\AdBundle\EventListener;

use SegundoUso\AdBundle\Exception\InvalidTokenException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $event->getDispatcher()->removeListener(KernelEvents::EXCEPTION, array($this, 'onKernelException'));

        $exception = $event->getException();

        if ($exception instanceof InvalidTokenException) {
            $event->setResponse(new Response($exception->getMessage()));
            return;
        }
    }

}