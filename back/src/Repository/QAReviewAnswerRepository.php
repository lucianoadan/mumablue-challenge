<?php

namespace App\Repository;

use App\Entity\QAReviewAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QAReviewAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method QAReviewAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method QAReviewAnswer[]    findAll()
 * @method QAReviewAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QAReviewAnswerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QAReviewAnswer::class);
    }

//    /**
//     * @return QAReviewAnswer[] Returns an array of QAReviewAnswer objects
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
    public function findOneBySomeField($value): ?QAReviewAnswer
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
