<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/back/movie", name="app_back_movie")
     */
    public function index(): Response
    {
        return $this->render('back/movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }
}
