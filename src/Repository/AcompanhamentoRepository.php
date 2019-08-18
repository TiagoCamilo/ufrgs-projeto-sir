<?php

namespace App\Repository;

use App\Entity\Acompanhamento;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Acompanhamento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acompanhamento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acompanhamento[]    findAll()
 * @method Acompanhamento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcompanhamentoRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Acompanhamento::class);
    }

//    /**
//     * @return Acompanhamento[] Returns an array of Acompanhamento objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Acompanhamento
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
