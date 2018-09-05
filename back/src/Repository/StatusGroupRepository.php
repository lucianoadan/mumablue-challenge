<?php

namespace App\Repository;

use App\Entity\StatusGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StatusGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusGroup[]    findAll()
 * @method StatusGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StatusGroup::class);
    }

   
}
