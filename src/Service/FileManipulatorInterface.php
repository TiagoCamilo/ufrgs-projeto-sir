<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 04/11/18
 * Time: 16:21.
 */

namespace App\Service;

interface FileManipulatorInterface
{
    public function __construct(int $width, int $height);

    public function getImage(): ?string;

    public function setImage(string $image): FileManipulatorInterface;

    public function normalize();
}
