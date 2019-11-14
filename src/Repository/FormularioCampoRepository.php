<?php

namespace App\Repository;

use App\Entity\Escola;
use App\Entity\FormularioCampo;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FormularioCampo|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormularioCampo|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormularioCampo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormularioCampoRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FormularioCampo::class);
    }

    protected function getFilterByEscola(Escola $escola){
        return [];
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
