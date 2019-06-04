<?php

namespace App\Security;

use App\Entity\Aluno;
use App\Entity\User;
use App\Helpers\VoterHelper;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AppVoter extends Voter
{

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, VoterHelper::getSupportedActions())) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof Aluno) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
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

    private function canView(Aluno $object, User $user)
    {
        return $this->canEdit($object, $user);
    }

    private function canEdit(Aluno $object, User $user)
    {
        return $this->checkScope($object, $user);
    }

    private function checkScope(Aluno $object, User $user)
    {
        return $user->getEducador()->getEscola() === $object->getEscola();
    }
}
