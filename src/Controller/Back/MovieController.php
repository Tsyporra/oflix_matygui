<?php

namespace App\Controller\Back;

use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    /**
     * @Route("/back/movie")
     */
class MovieController extends AbstractController
{
    /**
     * READ
     * Affiche tous les films
     * @Route("/", name="app_back_movie")
     */
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();
        
        return $this->render('back/movie/index.html.twig', [
            'movies' => $movies,
        ]);
    }
}
