<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @extends ServiceEntityRepository<Client>
 *
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

//    /**
//     * @return Client[] Returns an array of Client objects
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

//    public function findOneBySomeField($value): ?Client
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function getSearchQuery(?string $searchQuery):Query{
    $queryBuilder = $this -> createQueryBuilder('rechercheClient');

    if ($searchQuery){
        $queryBuilder->andWhere(
            $queryBuilder ->expr()->orX(
                $queryBuilder -> expr() -> like('rechercheClient.id',':search'),
                $queryBuilder -> expr() -> like('rechercheClient.Nom',':search'),
                $queryBuilder -> expr() -> like('rechercheClient.Prenom',':search'),
                $queryBuilder -> expr() -> like('rechercheClient.Telephone',':search'),
                $queryBuilder -> expr() -> like('rechercheClient.NumCIN',':search')
            )
        ) -> setParameter('search',"%$searchQuery%");
    }
    return $queryBuilder->getQuery();
}
}
