<?php

namespace SegundoUso\AdBundle\Controller;

use SegundoUso\AdBundle\Event\AdEvent;
use SegundoUso\AdBundle\Event\FormEvent;
use SegundoUso\AdBundle\Form\Type\AdType;
use SegundoUso\AdBundle\SegundoUsoAdEvents;
use SegundoUso\FrontendBundle\Form\Type\ContactAdvertiserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        /** @var $categoryManager \SegundoUso\AdBundle\Model\AdManager */
        $adManager = $this->get('seguso.ad_manager');

        $category = null;

        if (null !== $categoryId = $request->get('categoryId')) {
            $category = $this->getDoctrine()->getRepository('SegundoUsoAdBundle:Category')->find($categoryId);
            $ads = $adManager->findByCategoryAndPublished($category);
        } else {
            $ads = $adManager->findAllPublished();
        }

        return $this->render('SegundoUsoAdBundle:Default:index.html.twig', array(
            'ads' => $ads,
            'category' => $category
        ));
    }

    public function showAction(Request $request, $pid)
    {
        /** @var $categoryManager \SegundoUso\AdBundle\Model\AdManager */
        $adManager = $this->get('seguso.ad_manager');
        $ad = $adManager->findByPid($pid);

        $form = $this->createForm(new ContactAdvertiserType());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $message = \Swift_Message::newInstance()
                ->setSubject('Interés en tu anuncio en SegundoUso.org')
                ->setFrom('dev@segundouso.org')
                ->setTo($data['email'])
                ->setBody(
                    $this->render(
                        'SegundoUsoAdBundle:Email:contact_email.html.twig',
                        array(
                            'data' => $data,
                            'ad' => $ad
                        )
                    )
                )
                ->setContentType('text/html')
            ;
            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag()->add(
                'success',
                'Se ha enviado un email al anunciante. Él se pondrá en contacto contigo.'
            );

            return $this->redirect($this->generateUrl('segundo_uso_frontend_ad_show', array('pid' => $pid)));
        }

        return $this->render('SegundoUsoAdBundle:Default:show.html.twig', array(
            'ad' => $ad,
            'contactForm' => $form->createView()
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
