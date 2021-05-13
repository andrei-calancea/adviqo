<?php

namespace App\Repository;

use App\Entity\Adviser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Adviser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adviser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adviser[]    findAll()
 * @method Adviser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdviserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adviser::class);
    }

    // /**
    //  * @return Adviser[] Returns an array of Adviser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adviser
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
