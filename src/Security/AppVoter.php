<?php

namespace App\Security;

use App\Entity\LimiterEscolaInterface;
use App\Entity\Usuario;
use App\Helpers\VoterHelper;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AppVoter extends Voter
{
    protected function supports($attribute, $subject = null)
    {
        if (null === $subject) {
            return true;
        }

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

        if (false === VoterHelper::checkUserPermission($user, $attribute)) {
            return false;
        }

        if (null === $subject) {
            return true;
        }

        return $this->checkScope($subject, $user);
    }

    private function checkScope(LimiterEscolaInterface $object, Usuario $user)
    {
        return $user->getEscola() === $object->getEscola();
    }
}
