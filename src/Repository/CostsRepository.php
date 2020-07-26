<?php

namespace App\Repository;

use App\Entity\Costs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Costs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Costs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Costs[]    findAll()
 * @method Costs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Costs::class);
    }

    // /**
    //  * @return Costs[] Returns an array of Costs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Costs
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
