<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 04/11/18
 * Time: 13:51.
 */

namespace App\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\Aluno;
use App\Service\FileUploader;

class FileUploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Aluno) {
            return;
        }

        if ($fileName = $entity->getFile()) {
            if (file_exists($this->uploader->getTargetDirectory().'/'.$fileName)) {
                $entity->setFile(new File($this->uploader->getTargetDirectory().'/'.$fileName));
            }
        }
    }

    private function uploadFile($entity)
    {
        if (!$entity instanceof Aluno) {
            return;
        }

        $file = $entity->getFile();

        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            $entity->setFile($fileName);
        } elseif ($file instanceof File) {
            // prevents the full file path being saved on updates
            // as the path is set on the postLoad listener
            $entity->setFile($file->getFilename());
        }
    }
}
