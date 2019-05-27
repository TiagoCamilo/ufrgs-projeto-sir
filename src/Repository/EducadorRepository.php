<?php

namespace App\Repository;

use App\Entity\Educador;
use Symfony\Bridge\Doctrine\RegistryInterface;

class EducadorRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Educador::class);
    }
}
