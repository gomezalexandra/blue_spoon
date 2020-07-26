<?php

namespace App\Repository;

use App\Entity\FirstNeeds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FirstNeeds|null find($id, $lockMode = null, $lockVersion = null)
 * @method FirstNeeds|null findOneBy(array $criteria, array $orderBy = null)
 * @method FirstNeeds[]    findAll()
 * @method FirstNeeds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FirstNeedsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FirstNeeds::class);
    }

    // /**
    //  * @return FirstNeeds[] Returns an array of FirstNeeds objects
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
    public function findOneBySomeField($value): ?FirstNeeds
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
