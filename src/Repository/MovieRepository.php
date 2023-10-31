<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function add(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllOrderByAscDql()
    {
        // Besoin du manager pour créer nos requêtes avec Doctrine
        // On utilise l'EntityManager à chaque fois qu'on veut manipuler les données avec Doctrine
       $em = $this->getEntityManager();
;      $query = $em->createQuery(
        // Construction de la reqête DQL => SELECT tous les objets movie depuis l'entité Movie
        // C'est au moment de 'AS m' qu'on définit le m 
        // Ordonnés par titre (title) par ordre alphabétique
        // SELECT m => sélectionne tous les objets Movie (autre manière pour récupérer juste une propriété => SELECT m.title) 
        'SELECT m 
         FROM App\entity\Movie 
         AS m 
         ORDER BY m.title ASC');
         // Ici on va exécuter la requête pour récupérer les données attendues
         $movies = $query->getResult();
         return $movies;
    }

    // Même requête avec le QUERYBUILDER
    public function findAllOrderByAscQB()
    {
        $em = $this->getEntityManager();

        $qb = $em->createQueryBuilder();

        $query = $qb->select('m')
                    ->from(Movie::class, 'm')
                    ->orderBy('m.release_date', 'DESC');

        $query = $query->getQuery();                
        $movies = $query->getResult();

        return $movies;
    }

    // récupérer les Movie par date de sortie récente
    public function findAllOrderByReleaseDateDql()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
        'SELECT m 
         FROM App\entity\Movie 
         AS m 
         ORDER BY m.release_date DESC');

         $moviesByRealiseDate = $query->getResult();
         return $moviesByRealiseDate;
    }

//    /**
//     * @return Movie[] Returns an array of Movie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Movie
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
