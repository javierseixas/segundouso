<?php

namespace SegundoUso\AdBundle\Controller;

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
        $adManager = $this->container->get('seguso.ad_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $ad = $adManager->createAd();
        $ad->setPublished(false);

        $form = $this->createForm(new AdType(), $ad);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(SegundoUsoAdEvents::AD_CREATE_SUCCESS, $event);

            $adManager->updateAd($ad);

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
