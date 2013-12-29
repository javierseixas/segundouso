<?php

namespace SegundoUso\AdBundle\EventListener;

use SegundoUso\AdBundle\Event\AdEvent;
use SegundoUso\AdBundle\Model\AdInterface;

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
            ->setTo($this->getEmail($ad))
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

    // TODO Abstract this function to a new class. The same problem in AdBundle\Controller\DefaultController class.
    private function getEmail(AdInterface $ad)
    {
        if (null !== $ad->getUser()) {
            return $ad->getUser()->getEmail();
        } else {
            return $ad->getAdvertiser()->getEmail();
        }
    }
}