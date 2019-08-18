<?php

namespace App\Service;

use App\Entity\Escola;
use App\Repository\FormularioRepository;
use Doctrine\Common\Persistence\ObjectManager;

class FormularioModelo
{
    private $formularioRepository;
    private $entityManager;

    /**
     * FormularioModelo constructor.
     *
     * @param $formularioRepository
     */
    public function __construct(ObjectManager $entityManager, FormularioRepository $formularioRepository)
    {
        $this->formularioRepository = $formularioRepository;
        $this->entityManager = $entityManager;
    }

    public function createFormModels(Escola $escola): bool
    {
        $formulariosModelos = $this->formularioRepository->findBy(['escola' => null], ['id' => 'ASC']);
        foreach ($formulariosModelos as $formularioModelo) {
            $escola->addFormulario(clone $formularioModelo);
        }

        $this->entityManager->persist($escola);
        $this->entityManager->flush();

        return true;
    }
}
