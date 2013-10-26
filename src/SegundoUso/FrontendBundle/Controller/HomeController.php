<?php

namespace SegundoUso\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function homeAction()
    {
        return $this->render('SegundoUsoFrontendBundle:Home:home.html.twig', array());
    }
}
