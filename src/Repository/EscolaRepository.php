<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 13/10/18
 * Time: 11:38.
 */

namespace App\Repository;

use App\Entity\Escola;
use Symfony\Bridge\Doctrine\RegistryInterface;

class EscolaRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Escola::class);
    }

    protected function getFilterByEscola(Escola $escola)
    {
        return ['id' => $escola];
    }
}
