<?php

namespace SegundoUso\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccountController extends Controller
{
    public function showMyAdsAction()
    {
        /** @var $categoryManager \SegundoUso\AdBundle\Model\AdManager */
        $adManager = $this->get('seguso.ad_manager');

        $user = $this->get('security.context')->getToken()->getUser();

        $ads = $adManager->findAdsForUser($user);

        return $this->render('SegundoUsoUserBundle:Account:my_ads.html.twig', array(
            'ads' => $ads
        ));
    }

    public function showFavoriteAdsAction()
    {
        return $this->render('SegundoUsoUserBundle:Account:favorite_ads.html.twig');
    }
}