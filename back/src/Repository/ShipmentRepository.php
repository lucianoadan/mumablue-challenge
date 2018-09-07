<?php

namespace App\Repository;

use App\Entity\Shipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Shipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shipment|null findOneBy(array $criteria, array $shipmentBy = null)
 * @method Shipment[]    findAll()
 * @method Shipment[]    findBy(array $criteria, array $shipmentBy = null, $limit = null, $offset = null)
 */
class ShipmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Shipment::class);
    }

    public function existsOrderShipment($orderRef): bool
    {

        return intval($this->createQueryBuilder('s')
                ->select('count(s.id)')
                ->andWhere('s.orderRef = :orderRef')
                ->setParameter('orderRef', $orderRef)
                ->getQuery()
                ->getSingleScalarResult()) > 0;
    }

    public function exists($shipmentId): bool
    {

        return intval($this->createQueryBuilder('s')
                ->select('count(s.id)')
                ->andWhere('s.id = :shipmentId')
                ->setParameter('shipmentId', $shipmentId)
                ->getQuery()
                ->getSingleScalarResult()) > 0;
    }

    public function findWhereLastStatusInGroup($groupId)
    {
        return $this->createQueryBuilder('sh')
            ->distinct()
            ->from('\App\Entity\StatusUpdate', 'su')
            ->from('\App\Entity\Status', 's')
            ->where('su.shipment = sh.id')
            ->andWhere('s.id = su.status')
            ->andWhere('su.createdAt = (SELECT MAX(su2.createdAt) FROM \App\Entity\StatusUpdate su2 WHERE su.shipment = su2.shipment )')
            ->andWhere('s.statusGroup = ' . $groupId)
            ->getQuery()
            ->execute();
    }

    public function findNotDelivered()
    {
        return $this->createQueryBuilder('sh')
            ->distinct()
            ->from('\App\Entity\StatusUpdate', 'su')
            ->from('\App\Entity\Status', 's')
            ->from('\App\Entity\StatusGroup', 'g')
            ->where('su.shipment = sh.id')
            ->andWhere('s.id = su.status')
            ->andWhere('s.statusGroup = g.id')
            ->andWhere('su.createdAt = (SELECT MAX(su2.createdAt) FROM \App\Entity\StatusUpdate su2 WHERE su.shipment = su2.shipment )')
            ->andWhere('g.code <> :groupCode')
            ->setParameter('groupCode', 'delivered')
            ->getQuery()
            ->execute();
    }

    public function findWhereLastStatus($statusId)
    {

        return $this->createQueryBuilder('sh')
            ->distinct()
            ->from('\App\Entity\StatusUpdate', 'su')
            ->where('su.shipment = sh.id')
            ->andWhere('su.createdAt = (SELECT MAX(su2.createdAt) FROM \App\Entity\StatusUpdate su2 WHERE su.shipment = su2.shipment )')
            ->andWhere('su.status = :statusId')
            ->setParameter('statusId', $statusId)
            ->getQuery()
            ->execute();

    }

    public function create(Shipment $shipment)
    {
        $this->getEntityManager()->persist($shipment->getShipToAddr());
        $this->getEntityManager()->persist($shipment);
        $this->getEntityManager()->flush();

        return $this;
    }

    public function update(Shipment $shipment)
    {
        $this->getEntityManager()->persist($shipment);
        $this->getEntityManager()->flush();

        return $this;
    }

//    /**
    //     * @return Shipment[] Returns an array of Shipment objects
    //     */
    /*
    public function findByExampleField($value)
    {
    return $this->createQueryBuilder('o')
    ->andWhere('o.exampleField = :val')
    ->setParameter('val', $value)
    ->shipmentBy('o.id', 'ASC')
    ->setMaxResults(10)
    ->getQuery()
    ->getResult()
    ;
    }
     */

    /*
public function findOneBySomeField($value): ?Shipment
{
return $this->createQueryBuilder('o')
->andWhere('o.exampleField = :val')
->setParameter('val', $value)
->getQuery()
->getOneOrNullResult()
;
}
 */
}
