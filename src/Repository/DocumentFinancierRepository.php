<?php

namespace App\Repository;

use App\Entity\DocumentFinancier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DocumentFinancier>
 *
 * @method DocumentFinancier|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentFinancier|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentFinancier[]    findAll()
 * @method DocumentFinancier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentFinancierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentFinancier::class);
    }

//    /**
//     * @return DocumentFinancier[] Returns an array of DocumentFinancier objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DocumentFinancier
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
