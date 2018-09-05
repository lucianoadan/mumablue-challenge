<?php

namespace App\Repository;

use App\Entity\StatusUpdate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StatusUpdate|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusUpdate|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusUpdate[]    findAll()
 * @method StatusUpdate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusUpdateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StatusUpdate::class);
    }

//    /**
//     * @return StatusUpdate[] Returns an array of StatusUpdate objects
//     */
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
    public function findOneBySomeField($value): ?StatusUpdate
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
