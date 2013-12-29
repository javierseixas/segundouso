<?php

namespace SegundoUso\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function dashboardAction()
    {
        return $this->render('SegundoUsoFrontendBundle:Admin:dashboard.html.twig', array(
        ));
    }
}