<?php

namespace App\Repository;

use App\Entity\Success;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Success|null find($id, $lockMode = null, $lockVersion = null)
 * @method Success|null findOneBy(array $criteria, array $orderBy = null)
 * @method Success[]    findAll()
 * @method Success[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuccessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Success::class);
    }

    // /**
    //  * @return Success[] Returns an array of Success objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Success
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
