<?php

namespace App\Repository;

use App\Entity\ModeIntervention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModeIntervention>
 *
 * @method ModeIntervention|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModeIntervention|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModeIntervention[]    findAll()
 * @method ModeIntervention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModeInterventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModeIntervention::class);
    }

//    /**
//     * @return ModeIntervention[] Returns an array of ModeIntervention objects
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

//    public function findOneBySomeField($value): ?ModeIntervention
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
