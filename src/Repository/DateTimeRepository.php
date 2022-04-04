<?php

namespace App\Repository;

use App\Entity\DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DateTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateTime[]    findAll()
 * @method DateTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateTime::class);
    }

    // /**
    //  * @return DateTime[] Returns an array of DateTime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DateTime
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
