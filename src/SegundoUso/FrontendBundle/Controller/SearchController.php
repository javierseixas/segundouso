<?php

namespace SegundoUso\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    public function indexAction(Request $request)
    {
        /** @var $categoryManager \SegundoUso\AdBundle\Model\AdManager */
        $adManager = $this->get('seguso.ad_manager');

        $municipality = $this->get('seguso.municipality_manager')->findBySlug($request->getSession()->get('currentMunicipality'));

        $ads = $adManager->findBySearchedTerm($request->get('searched_term'), $municipality);

        return $this->render('SegundoUsoAdBundle:Default:index.html.twig', array(
            'ads' => $ads,
            'category' => null
        ));
    }
}
