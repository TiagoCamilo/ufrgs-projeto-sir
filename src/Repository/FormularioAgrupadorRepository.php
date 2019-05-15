<?php

namespace App\Repository;

use App\Entity\FormularioAgrupador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FormularioAgrupador|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormularioAgrupador|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormularioAgrupador[]    findAll()
 * @method FormularioAgrupador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormularioAgrupadorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FormularioAgrupador::class);
    }

    // /**
    //  * @return FormularioAgrupador[] Returns an array of FormularioAgrupador objects
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
    public function findOneBySomeField($value): ?FormularioAgrupador
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
