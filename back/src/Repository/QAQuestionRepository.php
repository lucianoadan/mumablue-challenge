<?php

namespace App\Repository;

use App\Entity\QAQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QAQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method QAQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method QAQuestion[]    findAll()
 * @method QAQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QAQuestionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QAQuestion::class);
    }

//    /**
//     * @return QAQuestion[] Returns an array of QAQuestion objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QAQuestion
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
