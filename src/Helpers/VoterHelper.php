<?php

namespace App\Helpers;

class VoterHelper
{
    public static $VIEW = 'VIEW';
    public static $EDIT = 'EDIT';
    public static $LIST = 'LIST';
    public static $NEW = 'NEW';
    public static $DELETE = 'DELETE';

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
