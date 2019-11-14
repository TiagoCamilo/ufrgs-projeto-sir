<?php

namespace App\Repository;

use App\Entity\Escola;
use App\Entity\FormularioRegistro;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FormularioRegistro|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormularioRegistro|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormularioRegistro[]    findAll()
 * @method FormularioRegistro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormularioRegistroRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FormularioRegistro::class);
    }

    protected function getFilterByEscola(Escola $escola){
        return ['aluno' => $escola->getAlunos()->toArray()];
    }

    // /**
    //  * @return FormularioRegistro[] Returns an array of FormularioRegistro objects
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
    public function findOneBySomeField($value): ?FormularioRegistro
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
