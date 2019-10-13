<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 04/11/18
 * Time: 16:21.
 */

namespace App\Service;

interface IFileManipulator
{
    public function __construct(int $width, int $height);

    public function getImage(): ?string;

    public function setImage(string $image): IFileManipulator;

    public function normalize();

}
