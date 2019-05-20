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

    public function getAlunoValues()
    {
        return $this->alunoRepository->findAll();
    }

    public function getFieldList()
    {
        return $this->fieldList;
    }

    public function getTemplateByField($fieldType)
    {
        switch ($fieldType) {
            case 'TextType':
                return 'others/_field_text.html.twig';
            case 'TextareaType':
                return 'others/_field_textarea.html.twig';
            case 'LabelType':
                return 'others/_field_label.html.twig';
            case 'DateType':
                return 'others/_field_date.html.twig';
            case 'AlunoType':
                return 'others/_field_aluno.html.twig';
            default:
                return 'others/_field_label.html.twig';
        }
    }
}
