<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\Movie;
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
    public function list() 
    {
        $movies = Movie::getMovies();

        return $this->render('movie/list-movie.html.twig', [
            'movies' => $movies
        ]);
    }

    /**
     * exemple page de détail d'un film avec ID
     * @Route("/show/{id}", name="movies_show", methods={"GET"})
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
     * Page d'un film ou d'une série en particulier
     * @Route("/show/{releaseDate}", name="movies_show")
   */
  //  public function show(int $releaseDate): Response
//    {

 //       $movie = Movie::getMovieByReleaseDate($releaseDate);

 //      if ($movie === null) {
  //        throw $this->createNotFoundException('Aucun film trouvé');
  //     }

  //          return $this->render('movie/show.html.twig', [
  //              'movie' => $movie
   //         ]);
  //  }

    /**
     * Page des films et séries favoris
     * @Route("/favorites", name="movies-favorites")
     */
    public function favorites()
    {
        return $this->render('movie/favorites.html.twig');
    }

}