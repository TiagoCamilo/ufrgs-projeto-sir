<?php

namespace App\Repository;

use App\Entity\Aluno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Aluno|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aluno|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aluno[]    findAll()
 * @method Aluno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlunoRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Aluno::class);
    }

//    /**
//     * @return Aluno[] Returns an array of Aluno objects
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
    public function findOneBySomeField($value): ?Aluno
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
