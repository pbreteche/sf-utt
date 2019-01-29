<?php

namespace AppBundle\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class VisitExtension extends AbstractExtension
{

    private $session;

    private $request;

    public function __construct(SessionInterface $session, RequestStack $stack)
    {
        $this->session = $session;
        $this->request = $stack->getMasterRequest();
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('visit', [$this, 'showVisit']),
        ];
    }

    public function showVisit()
    {
        $currentUrl = $this->request->attributes->get('url');
        $visits = $this->session->get('visit');
        $output = '';
        foreach ($visits[$currentUrl] as $visit) {
            $output .= '<li>' . $visit . '</li>';
        }
        $output = '<ul>' . $output . '</ul>';
        return 'les visites pour ' . $currentUrl . ':' . $output;
    }
}