<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
/**
 * @extends ServiceEntityRepository<Categorie>
 *
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

//    /**
//     * @return Categorie[] Returns an array of Categorie objects
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

//    public function findOneBySomeField($value): ?Categorie
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function getSearchQuery(?string $searchQuery):Query{
        $queryBuilder = $this -> createQueryBuilder('rechercheCategorie');

        if ($searchQuery){
            $queryBuilder->andWhere(
                $queryBuilder ->expr()->orX(
                    $queryBuilder -> expr() -> like('rechercheCategorie.id',':search'),
                    $queryBuilder -> expr() -> like('rechercheCategorie.Nom',':search'),
                    $queryBuilder -> expr() -> like('rechercheCategorie.NombreChaine',':search'),
                    $queryBuilder -> expr() -> like('rechercheCategorie.Prix',':search')
                )
            ) -> setParameter('search',"%$searchQuery%");
        }
        return $queryBuilder->getQuery();
    }
}
