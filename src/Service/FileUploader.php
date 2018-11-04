<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 04/11/18
 * Time: 13:43
 */

namespace App\Service;

use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
            $fileNameComplete = $this->getTargetDirectory().'/'.$fileName;
            Image::make($fileNameComplete)->resize(400,400)->save($fileNameComplete);
        } catch (Exception $e) {
            dump($e);
            die();
        }

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}