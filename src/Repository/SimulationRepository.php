<?php

namespace App\Repository;

use App\Entity\Simulation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Simulation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Simulation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Simulation[]    findAll()
 * @method Simulation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SimulationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Simulation::class);
    }

    /**
     * @return Simulation[]
     */
    public function findAllSimulationsMatching(string $query, string $userId)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.name LIKE :query')
            ->andWhere('s.user_id = :userId')
            ->setParameter('query', '%'.$query.'%')
            ->setParameter('userId', $userId)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Simulation[]
     */
    public function getMySimulations(string $userId)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.user_id = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('s.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
    /*{
        return $this->createQueryBuilder('s')
            ->orderBy('s.name', 'ASC')
            ->getQuery()
            ->execute()
            ;
    }*/

    // /**
    //  * @return Simulation[] Returns an array of Simulation objects
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
    public function findOneBySomeField($value): ?Simulation
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
