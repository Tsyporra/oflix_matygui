<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\MovieRepository;
use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewController extends AbstractController
{
    /**
     * @Route("/review/add/{id}", name="app_review_add")
     */
    public function create(int $id, Request $request, ReviewRepository $reviewRepository, MovieRepository $movieRepository)
    {
        $movieById = $movieRepository->find($id);
        $review = new Review();
       
        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);
       
        dump($review);
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
