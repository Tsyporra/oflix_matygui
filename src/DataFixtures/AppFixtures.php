<?php

namespace App\DataFixtures;

use App\DataFixtures\Provider\OflixProvider;
use DateTime;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Season;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // instancier la classe oflixprovider (fournisseur);
        $oflixProvider = new OflixProvider();

        // On va créer 20 genres
        $genreList = []; // Pour l'instant on init le tableau

        for ($i = 0; $i < 20; $i++) {
            // A chaque tour de boucle, on créer une entité Genre
            $genre = new Genre();
            // On va la parametrer 
            $genre->setName($oflixProvider->genreRand()); // setName dans l'entité Genre est le setter qui permet de lui donner un nom
            $genreList[] = $genre;
            $manager->persist($genre);
        }

        // On créer 20 films/serie

        for ($m = 0; $m < 20; $m++) {
            $movie = new Movie();
            // On va parametrer $movie
            $movie->setTitle($oflixProvider->movieRand());
            // mt_rand prend 2 nombre en paramtre
            $type = mt_rand(0, 1) === 1 ? 'Film' : 'Série'; // Si mt_rand(0, 1) === 1 alors le $type = 'Film' sinon sera egal a 'Serie'
            $movie->setType($type);
            $movie->setReleaseDate(new DateTime('2018-05-12'));
            $movie->setDuration(90);
            $movie->setPoster('https://m.media-amazon.com/images/M/MV5BN2ZmYjg1YmItNWQ4OC00YWM0LWE0ZDktYThjOTZiZjhhN2Q2XkEyXkFqcGdeQXVyNjgxNTQ3Mjk@._V1_SX300.jpg');
            $movie->setRating(4.4);
            $movie->setSummary('1983, à Hawkins dans l\'Indiana. Après la disparition d\'un garçon de 12 ans dans des circonstances mystérieuses, la petite ville du Midwest est témoin d\'étranges phénomènes.');
            $movie->setSynopsis('A Hawkins, en 1983 dans l\'Indiana. Lorsque Will Byers disparaît de son domicile, ses amis se lancent dans une recherche semée d’embûches pour le retrouver. Dans leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite. Les garçons se lient d\'amitié avec la demoiselle tatouée du chiffre "11" sur son poignet et au crâne rasé et découvrent petit à petit les détails sur son inquiétante situation. Elle est peut-être la clé de tous les mystères qui se cachent dans cette petite ville en apparence tranquille…');
            // Ci dessous je lie 2 genre a mon film
            $movie->addGenre($genreList[mt_rand(0, 10)]); // Je lie mon objet $movie au genreList[0]
            $movie->addGenre($genreList[mt_rand(11, 19)]); // Je lie mon objet $movie au genreList[0]

            // Si le type est = a Série, alors on va ajouter une saison
            if ($type === 'Série') {
                // On créer une entité Season 
                $season = new Season();
                // saison 1
                $season->setNumber(1);
                // 10 épisodes
                $season->setEpisodesNumber(10);
                // on l'associe a la serie 
                $season->setMovie($movie);
                $manager->persist($season);
            }
            $manager->persist($movie);
        }

        $manager->flush();
    }
}
