<?php

namespace SegundoUso\AdBundle\Controller;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller
{
    const FAVORITES_COOKIE_NAME = 'seguso_favorites';

    public function markAdAction($id)
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

    public function favoriteAdAction(Request $request, $id)
    {
        if (null !== $user = $this->getUser()) {
            $ad = $this->get('seguso.ad_manager')->find($id);
            $user->addFavouriteAd($ad);
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
        }

        $favorites = $request->cookies->get(self::FAVORITES_COOKIE_NAME);

        if (null === $favorites) {
            $favorites = array();
        } else {
            $favorites = json_decode($favorites, true);
        }

        $favorites[] = $id;
        $favorites = array_unique($favorites);

        $response = new JsonResponse(array('success' => true));
        $response->headers->setCookie($this->createFavoritesCookie($favorites));

        return $response;
    }

    public function unfavoriteAdAction(Request $request, $id)
    {
        if (null !== $user = $this->getUser()) {
            $ad = $this->get('seguso.ad_manager')->find($id);
            $user->removeFavouriteAd($ad);
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
        }

        $favorites = $request->cookies->get(self::FAVORITES_COOKIE_NAME);

        if (null === $favorites) {
            return new JsonResponse(array('success' => true));
        } else {
            $favorites = json_decode($favorites, true);
        }

        $favorites = array_diff($favorites, array($id));

        $response = new JsonResponse(array('success' => true));
        $response->headers->setCookie($this->createFavoritesCookie($favorites));

        return $response;

    }

    private function createFavoritesCookie(array $favorites)
    {
        $expireDate = new \DateTime();
        $expireInterval = new \DateInterval('P1Y');

        return new Cookie(self::FAVORITES_COOKIE_NAME, json_encode($favorites), $expireDate->add($expireInterval));
    }

    private function sendEmailNotice($ad)
    {
        // TODO Move this to a better place and set emails from config
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