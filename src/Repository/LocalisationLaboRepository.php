<?php

namespace App\Repository;

use App\Entity\LocalisationLabo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LocalisationLabo>
 *
 * @method LocalisationLabo|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocalisationLabo|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocalisationLabo[]    findAll()
 * @method LocalisationLabo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocalisationLaboRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LocalisationLabo::class);
    }

//    /**
//     * @return LocalisationLabo[] Returns an array of LocalisationLabo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LocalisationLabo
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
