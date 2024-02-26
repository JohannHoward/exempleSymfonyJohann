<?php

namespace App\Repository;

use App\Entity\TypeChaine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @extends ServiceEntityRepository<TypeChaine>
 *
 * @method TypeChaine|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeChaine|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeChaine[]    findAll()
 * @method TypeChaine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeChaineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeChaine::class);
    }

//    /**
//     * @return TypeChaine[] Returns an array of TypeChaine objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeChaine
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function getSearchQuery(?string $searchQuery):Query{
    $queryBuilder = $this -> createQueryBuilder('rechercheTypeChaine');

    if ($searchQuery){
        $queryBuilder->andWhere(
            $queryBuilder ->expr()->orX(
                $queryBuilder -> expr() -> like('rechercheTypeChaine.id',':search'),
                $queryBuilder -> expr() -> like('rechercheTypeChaine.Type',':search'),
            )
        ) -> setParameter('search',"%$searchQuery%");
    }
    return $queryBuilder->getQuery();
}
}
