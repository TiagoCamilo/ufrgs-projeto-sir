<?php

namespace App\Security;

use App\Entity\LimiterEscolaInterface;
use App\Entity\Usuario;
use App\Helpers\VoterHelper;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class AppVoter extends Voter
{
    protected function supports($attribute, $subject)
    {

        if (!$subject instanceof LimiterEscolaInterface) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        if (false === VoterHelper::checkUserPermission($user, $attribute)) {
            return false;
        }

        return $this->checkScope($subject, $user);
    }

    private function checkScope(LimiterEscolaInterface $object, Usuario $user)
    {
        return $user->getEducador()->getEscola() === $object->getEscola();
    }
}
