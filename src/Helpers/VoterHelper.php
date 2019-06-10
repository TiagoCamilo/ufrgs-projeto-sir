<?php

namespace App\Helpers;

use App\Entity\User;

class VoterHelper
{
    public static $VIEW = 'VIEW';
    public static $EDIT = 'EDIT';
    public static $LIST = 'LIST';
    public static $NEW = 'NEW';
    public static $DELETE = 'DELETE';

    public static function checkUserPermission(User $user, string $permission): bool
    {
        $exists = $user->getPerfil()->getPerfilControleAcoes()->exists(function ($key, $element) use ($permission) {
            return $permission === $element->getRoute();
        });

        return $exists;
    }

    /**
     * @return array
     */
    public static function getSupportedActions()
    {
        return [
            self::getVIEW(),
            self::getEDIT(),
            self::getLIST(),
            self::getNEW(),
            self::getDELETE(),
        ];
    }

    /**
     * @return string
     */
    public static function getVIEW(): string
    {
        return self::$VIEW;
    }

    /**
     * @return string
     */
    public static function getEDIT(): string
    {
        return self::$EDIT;
    }

    /**
     * @return string
     */
    public static function getLIST(): string
    {
        return self::$LIST;
    }

    /**
     * @return string
     */
    public static function getNEW(): string
    {
        return self::$NEW;
    }

    /**
     * @return string
     */
    public static function getDELETE(): string
    {
        return self::$DELETE;
    }
}
