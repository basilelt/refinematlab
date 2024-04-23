<?php

namespace App\Repository;

use App\Entity\CatalogueConsommable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatalogueConsommable>
 *
 * @method CatalogueConsommable|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatalogueConsommable|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatalogueConsommable[]    findAll()
 * @method CatalogueConsommable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatalogueConsommableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatalogueConsommable::class);
    }

//    /**
//     * @return CatalogueConsommable[] Returns an array of CatalogueConsommable objects
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

//    public function findOneBySomeField($value): ?CatalogueConsommable
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
