<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Classe\Movie;
use Symfony\Component\HttpFoundation\Response;

/**
  * @Route("/movies")
*/
class MovieController extends AbstractController
{
    /**
     * @Route("/list", name="movies_list")
     */
    public function allMovie() 
    {
        $movies = new Movie();
        $movies = $movies->getAll();

        return $this->render('movie/list-movie.html.twig', [
            'movies' => $movies
        ]);
    }

    /**
     * @Route("/show/{releaseDate}", name="movies_show")
     */
    public function show(int $releaseDate): Response
    {

        $movies = new Movie();

       $movie = $movies->getMovieByReleaseDate($releaseDate);

       if ($movie === null) {
          throw $this->createNotFoundException('Aucun film trouvé');
       }

            return $this->render('movie/show.html.twig', [
                'movie' => $movie
            ]);
    }



}