<?php

namespace App\Repository;

use App\Entity\Abonnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @extends ServiceEntityRepository<Abonnement>
 *
 * @method Abonnement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Abonnement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Abonnement[]    findAll()
 * @method Abonnement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbonnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Abonnement::class);
    }

//    /**
//     * @return Abonnement[] Returns an array of Abonnement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Abonnement
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    /**
    * @param  string|null $searchQuery
    * @param bool $actif
    * @return Query
    */

    // public function getSearchQuery(?string $searchQuery, bool $actif=True):Query{
        public function getSearchQuery(?string $searchQuery):Query{
        $queryBuilder = $this -> createQueryBuilder('rechercheAbonnement')
        ->leftJoin('rechercheAbonnement.Categorie','categorie')
        ->leftJoin('rechercheAbonnement.Client','client');

        if ($searchQuery){
            $queryBuilder->andWhere(
                $queryBuilder ->expr()->orX(
                    $queryBuilder -> expr() -> like('rechercheAbonnement.id',':search'),
                    $queryBuilder -> expr() -> like('rechercheAbonnement.Date_debut',':search'),
                    $queryBuilder -> expr() -> like('rechercheAbonnement.Date_Fin',':search'),
                    $queryBuilder -> expr() -> like('categorie.Nom',':search'),
                    $queryBuilder -> expr() -> like('client.Nom',':search')
                )
            ) -> setParameter('search',"%$searchQuery%");
        }
        // ajout condition actif
        // $queryBuilder->andWhere('rechercheAbonnement.Actif = :Actif')->setParameter('Actif',$actif);
        // $queryBuilder->orderBy("rechercheAbonnement.$sortField",$orderDirection);

        return $queryBuilder->getQuery();
    }
}

    