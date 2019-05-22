<?php

namespace App\Repository;

use App\Entity\Formulario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Formulario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formulario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formulario[]    findAll()
 * @method Formulario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormularioRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Formulario::class);
    }

    // /**
    //  * @return Formulario[] Returns an array of Formulario objects
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
    public function findOneBySomeField($value): ?Formulario
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
