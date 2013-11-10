<?php

namespace SegundoUso\AdBundle\Controller;

use SegundoUso\AdBundle\Event\AdEvent;
use SegundoUso\AdBundle\Event\FormEvent;
use SegundoUso\AdBundle\Form\Type\AdType;
use SegundoUso\AdBundle\SegundoUsoAdEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        /** @var $categoryManager \SegundoUso\AdBundle\Model\AdManager */
        $adManager = $this->get('seguso.ad_manager');

        $ads = $adManager->findAllPublished();

        return $this->render('SegundoUsoAdBundle:Default:index.html.twig', array(
            'ads' => $ads,
        ));
    }


    public function createAction(Request $request)
    {
        /** @var $adManager \SegundoUso\AdBundle\Model\AdManager */
        $adManager = $this->get('seguso.ad_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $ad = $adManager->createAd();
        $ad->setPublished(false);

        $form = $this->createForm(new AdType(), $ad);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $dispatcher->dispatch(SegundoUsoAdEvents::AD_CREATE_SUCCESS, new FormEvent($form, $request));

            $adManager->updateAd($ad);

            $dispatcher->dispatch(SegundoUsoAdEvents::AD_CREATE_COMPLETED, new AdEvent($ad));

            return $this->redirect($this->generateUrl('segundo_uso_frontend_ad_waiting_confirmation'));
        }

        return $this->render('SegundoUsoAdBundle:Default:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function waitingConfirmationAction()
    {
        return $this->render('SegundoUsoAdBundle:Default:waiting_confirmation.html.twig');
    }

    public function confirmationAction($pid)
    {
        /** @var $adManager \SegundoUso\AdBundle\Model\AdManager */
        $adManager = $this->get('seguso.ad_manager');

        if (null === $ad = $adManager->findByPid($pid)) {
            return $this->render('SegundoUsoAdBundle:Default:confirmation_failed.html.twg');
        }

        $adManager->publishAd($ad);

        return $this->render('SegundoUsoAdBundle:Default:confirmation.html.twig', array('ad' => $ad));
    }
}
