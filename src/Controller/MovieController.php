<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MovieRepository;
use App\Repository\CastingRepository;

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
        $movieTitleSearch = $movieRepository->findAllOrderByAscDqlSearch('nemo');

        return $this->render('movie/list-movie.html.twig', [
            'movies' => $movies,
            'movieTitleSearch' => $movieTitleSearch
        ]);
    }

    /**
     * exemple page de détail d'un film avec ID
     * @Route("/show/{id}", name="movies_show")
     */
    public function show($id, MovieRepository $movieRepository, CastingRepository $castingRepository)
    {
        $movie = $movieRepository->find($id);

        $castings = $castingRepository->findAllCastingByMovie($movie);
        dump($castings);
        if ($movie === null || $castings == null) {
            throw $this->createNotFoundException('Aucun film ou série trouvé(e)');
        }

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
            'castings' => $castings
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