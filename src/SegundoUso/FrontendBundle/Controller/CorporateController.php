<?php

namespace SegundoUso\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CorporateController extends Controller
{
    public function manifiestoAction()
    {
        return $this->render('SegundoUsoFrontendBundle:Corporate:manifiesto.html.twig', array(
        ));
    }

    public function aboutAction()
    {
        return $this->render('SegundoUsoFrontendBundle:Corporate:about.html.twig', array(
        ));
    }

    public function colaborateAction()
    {
        return $this->render('SegundoUsoFrontendBundle:Corporate:collaborate.html.twig', array(
        ));
    }

    public function contactAction()
    {
        return $this->render('SegundoUsoFrontendBundle:Corporate:contact.html.twig', array(
        ));
    }
}
