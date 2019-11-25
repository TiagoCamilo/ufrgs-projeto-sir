<?php

namespace App\Security;

use App\Entity\LimiterEscolaInterface;
use App\Entity\Usuario;
use App\Service\Perfil;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AppVoter extends Voter
{
    protected function supports($attribute, $subject = null)
    {
        // Se não tem entidade, retorna true para verificar permissao
        if (null === $subject) {
            return true;
        }

        // Se tem entidade, analisa somente se ela implementar interface de escopo
        if (!$subject instanceof LimiterEscolaInterface) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof Usuario) {
            return false;
        }

        // Verifica se possui a permissao em questao
        if (false === Perfil::checkUserPermission($user, $attribute)) {
            return false;
        }

        // Se tem a permissao e não tem entidade, retorna true
        if (null === $subject) {
            return true;
        }

        // Se tem entidade, valida o escopo da mesma em relacao ao usuario
        return $this->checkScope($subject, $user);
    }

    private function checkScope(LimiterEscolaInterface $object, Usuario $user)
    {
        // Usuario administrador nao possui escola, logo tem acesso a todas entidades
        return true === $user->isAdministrador() || $user->getEscola() === $object->getEscola();
    }
}
