<?php

namespace SegundoUso\AdBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller
{
    public function markAdAction(Request $request, $id)
    {
        /** @var $markManager \SegundoUso\AdBundle\Model\MarkManager */
        $markManager = $this->get('seguso.mark_manager');
        /** @var $adManager \SegundoUso\AdBundle\Model\AdManager */
        $adManager = $this->get('seguso.ad_manager');

        $ad = $adManager->find($id);
        $mark = $markManager->create();
        $mark->setAd($ad);

        $markManager->update($mark);

        $this->sendEmailNotice($ad);

        return new JsonResponse(array('success' => true));
    }

    private function sendEmailNotice($ad)
    {

        $message = \Swift_Message::newInstance()
            ->setSubject('Anuncio marcado como fraudulento en SegundoUso')
            ->setFrom('dev@segundouso.org')
            ->setTo('hola@segundouso.org')
            ->setBody(
                $this->render(
                    'SegundoUsoAdBundle:Email:fraudulent_notice.html.twig',
                    array('ad' => $ad)
                )
            )
            ->setContentType('text/html')
        ;
        $this->get('mailer')->send($message);
    }
}