<?php

namespace App\Repository;

use App\Entity\Status;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Status|null find($id, $lockMode = null, $lockVersion = null)
 * @method Status|null findOneBy(array $criteria, array $orderBy = null)
 * @method Status[]    findAll()
 * @method Status[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Status::class);
    }

    public function create(Status $status)
    {
        $this->getEntityManager()->persist($status);
        $this->getEntityManager()->flush();
        return $this;
    }

    public function getActualStatuses()
    {

        return $this->createQueryBuilder('s')
            ->distinct()
            ->from('\App\Entity\StatusUpdate', 'su')
            ->where('su.status = s.id')
            ->andWhere('su.createdAt = (SELECT MAX(su2.createdAt) FROM \App\Entity\StatusUpdate su2 WHERE su.shipment = su2.shipment )')
            ->getQuery()
            ->execute();

    }
}
