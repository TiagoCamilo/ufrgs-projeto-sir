<?php

namespace App\Helpers;

use App\Repository\AlunoRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class FormularioDinamicoHelper
{
    private $session;
    private $alunoRepository;
    private $aluno;
    private $usuario;

    private $fieldList = [
        'Texto' => 'TextType',
        'Área de Texto' => 'TextareaType',
        'Label' => 'LabelType',
        'Data' => 'DateType',
        'Aluno' => 'AlunoType',
        'Entidade' => 'EntityType',
    ];

    public function __construct(SessionInterface $session, AlunoRepository $alunoRepository, Security $security)
    {
        $this->session = $session;
        $this->alunoRepository = $alunoRepository;

        if (null !== $session->get('aluno_id')) {
            $this->aluno = $alunoRepository->find($session->get('aluno_id'));
        }

        $this->usuario = $security->getUser();

    }

    //TODO: Tornar "generico" permitindo utilizar qualquer entity
    public function getAlunoValues()
    {
        return $this->alunoRepository->findAll();
    }

    //TODO: Tornar "generico" permitindo utilizar qualquer entity
    public function getAlunoById($id)
    {
        return $this->alunoRepository->find($id);
    }

    public function getEntityValue($method){
        $obj = $this->getEntityReference('Usuario');

        if(false === method_exists($obj, $method)){
            return null;
        }

        return $obj->$method();
    }

    public function getFieldList()
    {
        return $this->fieldList;
    }

    private function getEntityReference($referenceType){
        switch ($referenceType){
            case 'Aluno':
                return $this->aluno;
            case 'Usuario':
                return $this->usuario;
            default:
                return null;
        }
    }

    public function getTemplateByField($fieldType)
    {
        switch ($fieldType) {
            case 'TextType':
                return 'formulario_dinamico/_field_text.html.twig';
            case 'TextareaType':
                return 'formulario_dinamico/_field_textarea.html.twig';
            case 'LabelType':
                return 'formulario_dinamico/_field_label.html.twig';
            case 'DateType':
                return 'formulario_dinamico/_field_date.html.twig';
            case 'AlunoType':
                return 'formulario_dinamico/_field_aluno.html.twig';
            case 'EntityType':
                return 'formulario_dinamico/_field_entity.html.twig';
            default:
                return 'formulario_dinamico/_field_label.html.twig';
        }
    }
}
