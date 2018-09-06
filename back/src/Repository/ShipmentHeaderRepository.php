<?php

namespace App\Repository;

use App\Entity\ShipmentHeader;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ShipmentHeader|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShipmentHeader|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShipmentHeader[]    findAll()
 * @method ShipmentHeader[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShipmentHeaderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ShipmentHeader::class);
    }
    public function findNotDelivered()
    {
        return $this->createQueryBuilder('sh')
            ->andWhere('status_group_code <> :groupCode')
            ->setParameter('groupCode', 'delivered')
            ->getQuery()
            ->execute();
    }

    public function findWhereLastStatus($statusId)
    {

        return $this->createQueryBuilder('sh')
            ->andWhere('sh.statusId = :statusId')
            ->setParameter('statusId', $statusId)
            ->getQuery()
            ->execute();

    }

    public function findWhereLastStatusInGroup($groupId)
    {
        return $this->createQueryBuilder('sh')
            ->andWhere('sh.statusGroupId = :statusGroupId')
            ->setParameter('statusGroupId', $groupId)
            ->getQuery()
            ->execute();
    }
}
