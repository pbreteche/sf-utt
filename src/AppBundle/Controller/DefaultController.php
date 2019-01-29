<?php

namespace AppBundle\Controller;


use AppBundle\Services\VisitInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
        ]);
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
