<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 04/11/18
 * Time: 13:43.
 */

namespace App\Service;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;
    private $fileManipulator;

    public function __construct($targetDirectory, IFileManipulator $fileManipulator)
    {
        $this->targetDirectory = $targetDirectory;
        $this->fileManipulator = $fileManipulator;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        try {
            $fileNameComplete = $file->move($this->getTargetDirectory(), $fileName);
            $this->fileManipulator->setImage($fileNameComplete)->normalize();
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
