<?php

namespace App\Security;

use App\Entity\LimiterEscolaInterface;
use App\Entity\User;
use App\Helpers\VoterHelper;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AppVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, VoterHelper::getSupportedActions())) {
            return false;
        }

        if (!$subject instanceof LimiterEscolaInterface) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        $object = $subject;

        switch ($attribute) {
            case VoterHelper::$VIEW:
                return $this->canView($object, $user);
            case VoterHelper::$EDIT:
                return $this->canEdit($object, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(LimiterEscolaInterface $object, User $user)
    {
        return $this->canEdit($object, $user);
    }

    private function canEdit(LimiterEscolaInterface $object, User $user)
    {
        return $this->checkScope($object, $user);
    }

    private function checkScope(LimiterEscolaInterface $object, User $user)
    {
        return $user->getEducador()->getEscola() === $object->getEscola();
    }
}
