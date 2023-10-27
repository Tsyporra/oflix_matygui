<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Movie;
use App\Repository\MovieRepository;

class MainController extends AbstractController
{
    /**
     *  Page d'accueil
     * 
     * @Route("/", name="home")
     */
    public function home(MovieRepository $movieRepository)
    {
        $movies = $movieRepository->findAll();
        dump($movies);

        // On retourne la vue twig avec le fichier home.html.twig
        return $this->render('main/home.html.twig', [
            'movies' => $movies,
        ]);
    }
}