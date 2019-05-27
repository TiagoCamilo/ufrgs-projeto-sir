<?php

namespace App\Repository;

use App\Entity\Escola;
use App\Entity\Formulario;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @method Formulario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formulario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formulario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormularioRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry, SessionInterface $session)
    {
        parent::__construct($registry, Formulario::class);
    }

    public function findAll()
    {
        return $this->findBy([], ['id' => 'ASC']);
    }

    public function findAllByEscola(Escola $escola)
    {
        if (null !== $escola->getId()) {
            return $this->findBy(['escola' => $escola->getId()], ['id' => 'ASC']);
        }

        return $this->findAll();
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
