<?php

namespace App\Repository;

use App\Entity\EntidadeCampoMapeavel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EntidadeCampoMapeavel|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntidadeCampoMapeavel|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntidadeCampoMapeavel[]    findAll()
 * @method EntidadeCampoMapeavel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntidadeCampoMapeavelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EntidadeCampoMapeavel::class);
    }

    // /**
    //  * @return EntidadeCampoMapeavel[] Returns an array of EntidadeCampoMapeavel objects
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
    public function findOneBySomeField($value): ?EntidadeCampoMapeavel
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
