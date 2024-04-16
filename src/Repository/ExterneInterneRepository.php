<?php

namespace App\Repository;

use App\Entity\ExterneInterne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExterneInterne>
 *
 * @method ExterneInterne|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExterneInterne|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExterneInterne[]    findAll()
 * @method ExterneInterne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExterneInterneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExterneInterne::class);
    }

//    /**
//     * @return ExterneInterne[] Returns an array of ExterneInterne objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExterneInterne
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
