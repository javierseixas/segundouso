<?php

namespace SegundoUso\AdBundle\EventListener;

use SegundoUso\AdBundle\Event\AdEvent;

class AdConfirmationEmailListener
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $twig
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function onNewAdCreated(AdEvent $event)
    {
        $ad = $event->getAd();

        $advertiser = $ad->getAdvertiser();

        $message = \Swift_Message::newInstance()
            ->setSubject('Confirmación de anuncio en SegundoUso.org')
            ->setFrom('dev@segundouso.org')
            ->setTo($advertiser->getEmail())
            ->setBody(
                $this->twig->render(
                    'SegundoUsoAdBundle:Email:ad_confirmation_email.html.twig',
                    array('ad' => $ad)
                )
            )
            ->setContentType('text/html')
        ;
        $this->mailer->send($message);
    }
}