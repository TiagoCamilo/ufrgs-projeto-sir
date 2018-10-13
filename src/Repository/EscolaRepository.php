<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 13/10/18
 * Time: 11:38.
 */

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class EscolaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Escola::class);
    }
}
