<?php

namespace App\Repository;

use App\Entity\Reservaide;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservaide|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservaide|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservaide[]    findAll()
 * @method Reservaide[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservaideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservaide::class);
    }

    // /**
    //  * @return Reservaide[] Returns an array of Reservaide objects
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
    public function findOneBySomeField($value): ?Reservaide
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
