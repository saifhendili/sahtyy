<?php

namespace App\Repository;

use App\Entity\FormAide;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormAide|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormAide|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormAide[]    findAll()
 * @method FormAide[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormAideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormAide::class);
    }

    // /**
    //  * @return FormAide[] Returns an array of FormAide objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormAide
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
