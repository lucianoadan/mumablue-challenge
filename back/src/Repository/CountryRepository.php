<?php

namespace App\Repository;

use App\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Country|null find($id, $lockMode = null, $lockVersion = null)
 * @method Country|null findOneBy(array $criteria, array $orderBy = null)
 * @method Country[]    findAll()
 * @method Country[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Country::class);
    }

    public function create(Country $country){
        $this->getEntityManager()->persist($country);
        $this->getEntityManager()->flush();

        return $this;
    }

    public function findShippingCountries(){
        return $this->createQueryBuilder('c')
            ->andWhere('c.availableShipping = :available')
            ->setParameter('available', true)
            ->orderBy('c.name', 'DESC')
            ->getQuery()
            ->execute();
    }
    
    public function findByCode($code){
        return $this->createQueryBuilder('c')
            ->andWhere('c.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getSingleResult();
    }

}
