<?php

namespace SegundoUso\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function homeAction()
    {
        /** @var $categoryManager \SegundoUso\AdBundle\Model\CategoryManager */
        $categoryManager = $this->get('seguso.category_manager');

        $categories = $categoryManager->findAll();

        return $this->render('SegundoUsoFrontendBundle:Home:home.html.twig', array(
            'categories' => $categories,
        ));
    }
}
