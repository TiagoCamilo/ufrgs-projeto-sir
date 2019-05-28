<?php

namespace App\Service;

use App\Repository\AlunoRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FormularioDinamicoHelper
{
    private $session;
    private $alunoRepository;
    private $fieldList = [
        'Texto' => 'TextType',
        'Área de Texto' => 'TextareaType',
        'Label' => 'LabelType',
        'Data' => 'DateType',
        'Aluno' => 'AlunoType',
    ];

    public function __construct(SessionInterface $session, AlunoRepository $alunoRepository)
    {
        $this->session = $session;
        $this->alunoRepository = $alunoRepository;
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

    public function getFieldList()
    {
        return $this->fieldList;
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
            default:
                return 'formulario_dinamico/_field_label.html.twig';
        }
    }
}
