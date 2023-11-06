<?php

namespace App\Controller\Front;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\MovieRepository;
use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends AbstractController
{
    /**
     * Ajout d'une critique sur un film donné
     * @Route("/review/add/{id}", name="app_review_add")
     */
    public function create(int $id, Request $request, ReviewRepository $reviewRepository, MovieRepository $movieRepository): Response
    {
        // Autre solution: passer l'entity Movie en parametre au lieu de l'id
        $movieById = $movieRepository->find($id);
        $review = new Review();
       
        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            $review->setMovie($movieById);

            $reviewRepository->add($review, true);

            return $this->redirectToRoute('movies_show', ['id' => $movieById->getId()]);
        }

        return $this->render("review/add.html.twig",[
            'form' => $form->createView(),
            'movieById' => $movieById
        ]);
        
    }
}
