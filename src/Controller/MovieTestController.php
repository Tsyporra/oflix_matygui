<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Season;
use App\Repository\MovieRepository;
use App\Repository\SeasonRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieTestController extends AbstractController
{
    /**
     * Créer un movie dans la bdd
     * @Route("/movie/test", name="app_movie_test")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        // On stock le manager de doctrine dans l'objet $entityManager
        // C'est grace a lui qu'on va intéragir avec la base de donnée
        $entityManager = $doctrine->getManager();

        // On créer une instance de l'entité Movie
        $movie = new Movie();

        // On va parametrer le film qu'on veut ajouter en bdd
        // On définit le titre du film
        $movie->setTitle('Jurassic park');
        // On définit la durée du film
        $movie->setDuration(120); // Dure 95 min
        // On définit la date de sortie
        $movie->setReleaseDate(new DateTime('1990-06-19')); // Classe DateTime pour créer une date au bon format (sinon erreur sql)
        $movie->setType("Film");
        $movie->setSummary("Ne pas réveiller le chat qui dort... C'est ce que le milliardaire John Hammond aurait dû se rappeler avant de se lancer dans le 'clonage' de dinosaures.");
        $movie->setSynopsis("Ne pas réveiller le chat qui dort... C'est ce que le milliardaire John Hammond aurait dû se rappeler avant de se lancer dans le 'clonage' de dinosaures. C'est à partir d'une goutte de sang absorbée par un moustique fossilisé que John Hammond et son équipe ont réussi à faire renaître une dizaine d'espèces de dinosaures. Il s'apprête maintenant avec la complicité du docteur Alan Grant, paléontologue de renom, et de son amie Ellie, à ouvrir le plus grand parc à thème du monde. Mais c'était sans compter la cupidité et la malveillance de l'informaticien Dennis Nedry, et éventuellement des dinosaures, seuls maîtres sur l'île...");
        $movie->setPoster("https://fr.web.img4.acsta.net/pictures/20/07/21/16/53/1319265.jpg");
        $movie->setRating(3.7);

        dump($movie);
        // On prépare la data => ATTENTION ici on envoie encore rien au serveur de bdd
        $entityManager->persist($movie);
        // Ci dessous on éxécute la requete
        // flush() ne prends aucun parametre car il va executer TOUTES les requetes attendues (tous ce qui a été persist($data))
        $entityManager->flush();

        return $this->render('movie_test/index.html.twig', [
            'controller_name' => 'MovieTestController',
        ]);
    }

    /**
     * fonction permettant de créer un movie (série) et ses saisons associées
     * @Route("/movie/serie/add")
     */
    public function addSerie(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        
        $serie = new Movie();
        $serie->setTitle('Stranger Things');
        $serie->setReleaseDate(new dateTime('2016-07-15'));
        $serie->setDuration(55);
        $serie->setType('Série');
        $serie->setSummary('Quand un jeune garçon disparaît, une petite ville découvre une affaire mystérieuse, des expériences secrètes, des forces surnaturelles terrifiantes... et une fillette. Watch all you want. Cet hommage aux classiques de l\'horreur et de la SF des années 80 a reçu des dizaines de nominations aux Emmys.');
        $serie->setSynopsis('Le 6 novembre 1983 dans la petite ville d’Hawkins dans l’Indiana, le jeune Will Byers rentre chez lui après une partie de ‘Donjons & Dragons’ lorsqu’il disparait dans des conditions mystérieuses. En enquêtant sur sa disparition, ses amis Dustin, Lucas et Mike rencontrent Onze, une jeune fille en fuite aux capacités télékinésiques qui pourrait bien les aider à retrouver Will et percer les mystères de la ville d’Hawkins. En parallèle, des évènements étranges prennent place dans la maison des Byers, tandis que le chef de la police, Jim Hopper, commence à avoir des soupçons sur l’implication du laboratoire national d’Hawkins dans la disparition du jeune garçon. Pour obtenir les réponses à leurs questions, la famille du jeune Will, ses amis et la police locale devront faire face à des forces terrifiantes et mystérieuses afin de le retrouver.');
        $serie->setPoster('https://m.media-amazon.com/images/W/MEDIAX_792452-T1/images/I/81eY+Q2pOGL._AC_SL1500_.jpg');
        $serie->setRating(4.6);

        $season1 = new Season();
        $season1->setNumber(1);
        $season1->setEpisodesNumber(8);
        $season1->setMovie($serie);

        $season2 = new Season();
        $season2->setNumber(2);
        $season2->setEpisodesNumber(9);
        $season2->setMovie($serie);

        $entityManager->persist($serie);
        $entityManager->persist($season1);
        $entityManager->persist($season2);

        $entityManager->flush();

        return $this->redirectToRoute("movies_list");


    }
}
