<?php

namespace AppBundle\Services;


use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class VisitService implements VisitInterface
{

    private $log;
    private $session;

    public function __construct(LoggerInterface $log, SessionInterface $session)
    {
        $this->log = $log;
        $this->session = $session;
    }

    public function addEntry($url)
    {
        $this->log->info('new visit in ' . $url);
        $visit = $this->session->get('visit', []);

        if (!key_exists($url, $visit)) {
            $visit[$url] = [];
        }

        $visit[$url][] = time();

        $this->session->set('visit', $visit);
    }
}