<?php

namespace App\Controller\Back;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/back/movie", name="app_back_movie")
 */
class MovieController extends AbstractController
{
    /**
     * READ
     * Affiche tous les films
     * 
     * @Route("/", name="")
     */
 /*   public function list(MovieRepository $movieRepository): Response
    {
        // Je stock dans $movies la liste de tous les films
        $movies = $movieRepository->findAll();

        // Je retourne ma vue en lui passant $movies
        return $this->render('back/movie/list.html.twig', [
            'movies' => $movies,
        ]);
    } */

     /**
     * CREATE
     * Créer un film
     * 
     * @Route("/create", name="_create")
     */
  /*  public function create(Request $request, MovieRepository $movieRepository): Response
    {
        // On créer une instance de Movie car ici on veut créer un film
        $movie = new Movie();
        
        // On créer notre formulaire et on le stock dans $form
        $form = $this->createForm(MovieType::class, $movie);    // Dans le formualire on va modifier $movie

        // Ici j'intercepte le contenu de la requete
        $form->handleRequest($request);
        
        // Ici je check si le formulaire a été soumis et validé
        if($form->isSubmitted() && $form->isValid()) {
            // On rentre dans le if SI le formulaire a été soumis
            // C'est donc ici qu'on va envoyer les données de $form dans la bdd
            // J'envoie $movie en bdd, true => pour faire le flush
            $movieRepository->add($movie, true);

        }

        // On retourne la vue voulue en lui passant le formulaire $form
        return $this->render('back/movie/create.html.twig', [
            'form' => $form->createView(),
        ]);
    } */


    /**
     * Met a jour un film
     *
     * @Route("/update/{id}", name="_update")
     */
 /*   public function update(Movie $movie, Request $request, MovieRepository $movieRepository)
    {
        dd($movie);
        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On rentre dans le if SI le formulaire a été soumis
            // C'est donc ici qu'on va envoyer les données de $form dans la bdd
            // J'envoie $movie en bdd, true => pour faire le flush
            $movieRepository->add($movie, true);

            return $this->redirectToRoute("app_back_movie");
        }

        return $this->render('back/movie/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

        /**
     * Supprime un film
     *
     * @Route("/delete/{id}", name="_delete")
     */
 /*   public function delete(Movie $movie, MovieRepository $movieRepository)
    {
        $movieRepository->remove($movie, true);
        return $this->redirectToRoute("app_back_movie");
    }  */
}
