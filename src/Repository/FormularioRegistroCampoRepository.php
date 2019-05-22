<?php

namespace App\Repository;

use App\Entity\FormularioRegistroCampo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FormularioRegistroCampo|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormularioRegistroCampo|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormularioRegistroCampo[]    findAll()
 * @method FormularioRegistroCampo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormularioRegistroCampoRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FormularioRegistroCampo::class);
    }

    // /**
    //  * @return FormularioRegistroCampo[] Returns an array of FormularioRegistroCampo objects
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
    public function findOneBySomeField($value): ?FormularioRegistroCampo
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
