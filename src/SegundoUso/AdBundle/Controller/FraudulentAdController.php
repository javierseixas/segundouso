<?php

namespace SegundoUso\AdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FraudulentAdController extends Controller
{
    public function indexAction()
    {
        /** @var \SegundoUso\AdBundle\Model\AdManager $adManager */
        $adManager = $this->get('seguso.ad_manager');

        $fraudulentAds = $adManager->findFraudulent();

        return $this->render('SegundoUsoAdBundle:Fraudulent:index.html.twig', array(
            'ads' => $fraudulentAds,
        ));
    }

    public function deleteAction($id)
    {
        /** @var \SegundoUso\AdBundle\Model\AdManager $adManager */
        $adManager = $this->get('seguso.ad_manager');

        $ad = $adManager->find($id);
        $adManager->remove($ad, true, true);

        return $this->redirect($this->generateUrl('segundo_uso_fraudulent_ads'));
    }
}