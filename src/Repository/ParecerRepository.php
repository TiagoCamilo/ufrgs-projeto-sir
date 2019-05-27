<?php

namespace App\Repository;

use App\Entity\Parecer;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Parecer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parecer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parecer[]    findAll()
 * @method Parecer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParecerRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Parecer::class);
    }

    // /**
    //  * @return Parecer[] Returns an array of Parecer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Parecer
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
