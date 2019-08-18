<?php

namespace App\Repository;

use App\Entity\PerfilControleAcao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PerfilControleAcao|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerfilControleAcao|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerfilControleAcao[]    findAll()
 * @method PerfilControleAcao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerfilControleAcaoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PerfilControleAcao::class);
    }

    // /**
    //  * @return PerfilControleAcao[] Returns an array of PerfilControleAcao objects
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
    public function findOneBySomeField($value): ?PerfilControleAcao
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
