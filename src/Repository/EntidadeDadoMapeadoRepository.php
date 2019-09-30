<?php

namespace App\Repository;

use App\Entity\EntidadeDadoMapeado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EntidadeDadoMapeado|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntidadeDadoMapeado|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntidadeDadoMapeado[]    findAll()
 * @method EntidadeDadoMapeado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntidadeDadoMapeadoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EntidadeDadoMapeado::class);
    }

    // /**
    //  * @return EntidadeDadoMapeado[] Returns an array of EntidadeDadoMapeado objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EntidadeDadoMapeado
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
