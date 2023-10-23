<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoSessionController extends AbstractController
{
    /**
     * @Route("/demo/session", name="demo_session")
     */
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $username = $session->get('username');
        dump($username);
        return $this->render('demo_session/index.html.twig', [
            'username' => $username,
        ]);
    }

    /**
     * @param Request $request
     * @Route("/demo/session/add", name="demo_add")
     */
    public function add(Request $request)
    {
        $session = $request->getSession();
        $session->set('username', 'Charles');

        return $this->redirectToRoute('demo_session');
    }
}
