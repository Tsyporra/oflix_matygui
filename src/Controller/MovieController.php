<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MovieRepository;

/**
  * @Route("/movie")
*/
class MovieController extends AbstractController
{
    /**
     * Page films et série
     * @Route("/list", name="movies_list")
     */
    public function list(MovieRepository $movieRepository) 
    {
        $movies = $movieRepository->findAll();

        return $this->render('movie/list-movie.html.twig', [
            'movies' => $movies
        ]);
    }

    /**
     * exemple page de détail d'un film avec ID
     * @Route("/show/{id}", name="movies_show")
     */
    public function show($id, MovieRepository $movieRepository)
    {
        $movie = $movieRepository->find($id);
        if ($movie === null) {
            throw $this->createNotFoundException('Aucun film ou série trouvé(e)');
        }

        return $this->render('movie/show.html.twig', [
            'movie' => $movie
        ]);
    }
   
    /**
     * Page des films et séries favoris
     * @Route("/favorites", name="movies-favorites")
     */
    public function favorites()
    {
        return $this->render('movie/favorites.html.twig');
    }

}