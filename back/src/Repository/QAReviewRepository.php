<?php

namespace App\Repository;

use App\Entity\QAReview;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QAReview|null find($id, $lockMode = null, $lockVersion = null)
 * @method QAReview|null findOneBy(array $criteria, array $orderBy = null)
 * @method QAReview[]    findAll()
 * @method QAReview[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QAReviewRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QAReview::class);
    }

    public function create(QAReview $review)
    {
        $this->getEntityManager()->persist($review);
        $this->getEntityManager()->flush();
    }
    public function existsForShipment($shipmentId): bool
    {

        return intval($this->createQueryBuilder('r')
                ->select('count(r.id)')
                ->andWhere('r.shipment = :shipmentId')
                ->setParameter('shipmentId', intval($shipmentId))
                ->getQuery()
                ->getSingleScalarResult()) > 0;
    }
    
}
