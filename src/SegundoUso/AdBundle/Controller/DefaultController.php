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

            return $this->redirect($this->generateUrl('task_success'));
        }

        return $this->render('SegundoUsoAdBundle:Default:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function confirmInstructionsAction()
    {
        return $this->render('SegundoUsoAdBundle:Default:confirm_instructions.html.twig');
    }
}
