<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 04/11/18
 * Time: 16:22.
 */

namespace App\Service;

use Intervention\Image\ImageManagerStatic as Image;

class FileManipulator implements IFileManipulator
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

    public function setImage(string $image): IFileManipulator
    {
        $this->image = $image;

        return $this;
    }

    public function resize()
    {
        Image::make($this->image)->resize($this->width, $this->height)->save($this->image);
    }
}
