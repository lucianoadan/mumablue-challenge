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
        $em = $this->getEntityManager();
        $cm = $em->getClassMetadata('App:Status');
        $cm->setTableName('vw_actual_statuses');
        $statuses = $this->createQueryBuilder('s')
            ->getQuery()
            ->execute();

            $cm->setTableName('status');

        return $statuses;
        
            

    }

    public function findByCode($code)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getSingleResult();
    }
}
