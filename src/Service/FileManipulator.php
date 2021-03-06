<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 04/11/18
 * Time: 16:22.
 */

namespace App\Service;

use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\Exception\NotReadableException;

class FileManipulator implements FileManipulatorInterface
{
    private $image;
    private $width;
    private $height;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): FileManipulatorInterface
    {
        $this->image = $image;

        return $this;
    }

    public function normalize()
    {
        try {
            //Image::make($this->image)->orientate()->resize($this->width, $this->height)->save($this->image);
            Image::make($this->image)->orientate()->save($this->image);
        } catch (NotReadableException $e) {
            //TODO: Condicionar a imagens antes deste ponto
            // Tratamento aplicado apenas a imagens
        }
    }
}
