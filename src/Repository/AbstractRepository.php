<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 18/11/18
 * Time: 17:42.
 */

namespace App\Repository;

use App\Entity\Escola;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractRepository extends ServiceEntityRepository
{
    public function findAll()
    {
        return $this->findBy([], ['id' => 'DESC']);
    }

    public function findAllByUserContext(Usuario $usuario)
    {
        return $this->findByUserContext($usuario, [], ['id' => 'DESC']);
    }

    public function findByUserContext(Usuario $usuario, array $criteria = [], array $orderBy = null, $limit = null, $offset = null)
    {
        $filter = [];

        if (count($criteria)) {
            $filter = array_merge($filter, $criteria);
        }

        $filter = array_merge($filter, $this->getFilterCustom());

        if ($usuario->getEscola() instanceof  Escola) {
            $filter = array_merge($filter, $this->getFilterByEscola($usuario->getEscola()));
        }

        return $this->findBy($filter, $orderBy, $limit, $offset);
    }

    protected function getFilterCustom(): array
    {
        return [];
    }

    abstract protected function getFilterByEscola(Escola $escola);
}
