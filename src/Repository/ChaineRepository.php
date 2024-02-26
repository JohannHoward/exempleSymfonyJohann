<?php

namespace App\Repository;

use App\Entity\Chaine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @extends ServiceEntityRepository<Chaine>
 *
 * @method Chaine|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chaine|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chaine[]    findAll()
 * @method Chaine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChaineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chaine::class);
    }

//    /**
//     * @return Chaine[] Returns an array of Chaine objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Chaine
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function getSearchQuery(?string $searchQuery):Query{
        $queryBuilder = $this -> createQueryBuilder('rechercheChaine')
        ->leftJoin('rechercheChaine.TypeChaine','TypeChaine');

        if ($searchQuery){
            $queryBuilder->andWhere(
                $queryBuilder ->expr()->orX(
                    $queryBuilder -> expr() -> like('rechercheChaine.id',':search'),
                    $queryBuilder -> expr() -> like('rechercheChaine.Nom',':search'),
                    $queryBuilder -> expr() -> like('rechercheChaine.Numero',':search'),
                    $queryBuilder -> expr() -> like('TypeChaine.Type',':search')
                )
            ) -> setParameter('search',"%$searchQuery%");
        }
        return $queryBuilder->getQuery();
    }
}
