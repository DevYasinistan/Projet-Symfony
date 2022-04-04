<?php

namespace App\Repository;

use App\Entity\Estimates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Estimates|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estimates|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estimates[]    findAll()
 * @method Estimates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstimatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estimates::class);
    }

    // /**
    //  * @return Estimates[] Returns an array of Estimates objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Estimates
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
