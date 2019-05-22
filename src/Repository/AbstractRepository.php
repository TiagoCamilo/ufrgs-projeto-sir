<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 18/11/18
 * Time: 17:42.
 */

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractRepository extends ServiceEntityRepository
{
    public function findAll()
    {
        return $this->findBy([], ['id' => 'DESC']);
    }
}
