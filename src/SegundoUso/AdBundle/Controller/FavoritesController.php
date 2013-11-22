<?php

namespace SegundoUso\AdBundle\Controller;

use SegundoUso\AdBundle\Event\AdEvent;
use SegundoUso\AdBundle\Event\FormEvent;
use SegundoUso\AdBundle\Exception\InvalidTokenException;
use SegundoUso\AdBundle\Form\Type\AdDeletionType;
use SegundoUso\AdBundle\Form\Type\AdType;
use SegundoUso\AdBundle\SegundoUsoAdEvents;
use SegundoUso\FrontendBundle\Form\Type\ContactAdvertiserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FavoritesController extends Controller
{
    public function indexAction(Request $request)
    {
        /** @var $categoryManager \SegundoUso\AdBundle\Model\AdManager */
        $adManager = $this->get('seguso.ad_manager');

        $favoriteAdsIds = json_decode($request->cookies->get(AjaxController::FAVORITES_COOKIE_NAME), true);

        // Get $ads by ids
        $ads = $adManager->findFavoritesInCookie($favoriteAdsIds);

        return $this->render('SegundoUsoAdBundle:Favorites:index.html.twig', array(
            'ads' => $ads
        ));
    }
}
