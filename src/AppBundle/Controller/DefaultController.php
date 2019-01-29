<?php

namespace AppBundle\Controller;


use AppBundle\Services\VisitInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
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
