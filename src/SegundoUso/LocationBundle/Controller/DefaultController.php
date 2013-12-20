<?php

namespace SegundoUso\LocationBundle\Controller;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
//        $cities = $this->getDoctrine()->getManager()->getRepository('SegundoUsoLocationBundle:Municipality')->findAll();
//
//        $em = $this->getDoctrine()->getManager();
//        $count = 1;
//
//        foreach ($cities as $city) {
//            if ($city->getId() < 7000) continue;
//
//            $city->setSlug(Urlizer::urlize($city->getName()));
//            $em->persist($city);
//
//            $em->flush();
//            $em->clear($city);
//        }
//
//        $em->flush();

        return $this->render('SegundoUsoLocationBundle:Default:index.html.twig', array('name' => $name));
    }

    public function listMunicipalitiesAction()
    {
        $municipalities = $this->getDoctrine()->getManager()->getRepository('SegundoUsoLocationBundle:Municipality')->findAll();

        return $this->render('SegundoUsoLocationBundle:Default:list_select_municipalities.html.twig', array('municipalities' => $municipalities));
    }

    public function changeMunicipalityAction(Request $request)
    {
        $municipality = $request->get('municipality');
        $session = $this->getRequest()->getSession();
        $session->set('currentMunicipality', $municipality);

        return $this->redirect($request->get('currentRoute'));
    }

}
