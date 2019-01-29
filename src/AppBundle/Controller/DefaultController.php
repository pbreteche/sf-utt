<?php

namespace AppBundle\Controller;


use AppBundle\Services\VisitInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/i18n")
     */
    public function i18nAction(TranslatorInterface $translator)
    {
        $message = $translator->trans('app.training.controller_message');

        return $this->render('default/i18n.html.twig', [
            'controllerMessage' => $message,
            'twigMessage' => 'app.training.twig_message'
        ]);
    }

    /**
     * @Route("/changeLocale", methods="PUT")
     * @Method({"PUT", "PATCH"})
     */
    public function changeLocaleAction(Session $session, Request $request)
    {
        $requestLocale = $request->request->get('locale');
        if (!in_array($requestLocale, ['fr', 'en'])) {
            throw new \Exception('locale non prise en charge');
        }

        $session->set('locale', $requestLocale);

        $redirectUrl = $request->request->get('redirect_url');
        return $this->redirect($redirectUrl);
    }

    /**
     * @Route("/{url}", name="homepage")
     */
    public function indexAction($url, Request $request, VisitInterface $visit)
    {
        $visit->addEntry($url);
        return $this->render('default/index.html.twig', [
        ]);
    }
}
