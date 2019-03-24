<?php

namespace App\Repository;

use App\Entity\FormularioCampo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FormularioCampo|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormularioCampo|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormularioCampo[]    findAll()
 * @method FormularioCampo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormularioCampoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FormularioCampo::class);
    }

    // /**
    //  * @return FormularioCampo[] Returns an array of FormularioCampo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormularioCampo
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}