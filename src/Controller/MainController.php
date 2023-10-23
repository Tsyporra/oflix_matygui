<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Classe\Movie;

class MainController extends AbstractController
{
    /**
     *  Page d'accueil
     * 
     * @Route("/", name="home")
     */
    public function home()
    {
        $movies = new Movie();
        $movies = $movies->getAll();

        // On retourne la vue twig avec le fichier home.html.twig
        return $this->render('main/home.html.twig', [
            'movies' => $movies,
        ]);
    }
}