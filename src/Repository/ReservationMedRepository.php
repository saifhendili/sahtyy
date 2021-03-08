<?php

namespace App\Repository;

use App\Entity\ReservationMed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservationMed|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationMed|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationMed[]    findAll()
 * @method ReservationMed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationMedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationMed::class);
    }

    // /**
    //  * @return ReservationMed[] Returns an array of ReservationMed objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReservationMed
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
