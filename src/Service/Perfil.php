<?php

namespace App\Service;

use App\Entity\PerfilControleAcao;
use App\Entity\Usuario;

class Perfil
{
    public static function checkUserPermission(Usuario $user, string $permission): bool
    {
        $exists = $user->getPerfil()->getPerfilControleAcoes()->exists(function ($key, PerfilControleAcao $element) use ($permission) {
            return $permission === $element->getRoute();
        });

        return $exists;
    }
}
