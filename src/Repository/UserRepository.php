<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 28/09/18
 * Time: 15:19.
 */

namespace App\Repository;

use App\Entity\User;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }
}
