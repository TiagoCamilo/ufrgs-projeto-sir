<?php

namespace App\Helpers;

use App\Repository\AlunoRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;
use App\Entity\Aluno;

class FormularioDinamicoHelper
{
    private $session;
    private $alunoRepository;
    private $aluno;
    private $usuario;
    private $em;

    private $fieldList = [
        'Texto' => 'TextType',
        'Área de Texto' => 'TextareaType',
        'Label' => 'LabelType',
        'Data' => 'DateType',
        'Entidade' => 'EntityType',
    ];

    public function __construct(SessionInterface $session, AlunoRepository $alunoRepository, Security $security, ObjectManager $entityManager)
    {
        $this->session = $session;
        $this->alunoRepository = $alunoRepository;
        $this->em = $entityManager;
        $this->usuario = $security->getUser();

        if (null !== $session->get('aluno_id')) {
            $this->aluno = $alunoRepository->find($session->get('aluno_id'));
        }
    }

    public function getFieldList()
    {
        return $this->fieldList;
    }

    public function loadDbEntityValue($entityName, $attribute){
        $objReferencia = $this->getEntityReference($entityName);

        $conn = $this->em->getConnection();

        $stmt = $conn->prepare("SELECT * FROM {$entityName} e WHERE e.id = :id");
        $stmt->execute(array('id' => $objReferencia->getId()));
        $register = $stmt->fetch();

        return $register[$attribute] ?? null;
    }

    private function loadDbEntityAttributeType($entityName, $attribute){
        $objReferencia = $this->getEntityReference($entityName);

        $metadata = $this->em->getClassMetadata(get_class($objReferencia));
        dump($metadata);
        if(false === isset($metadata->fieldNames[$attribute])){
            return null;
        }

        $attributeClassName = $metadata->fieldNames[$attribute];
        $field = $metadata->fieldMappings[$attributeClassName];

        return $field["type"];
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
            case 'EntityType':
                return 'formulario_dinamico/_field_entity.html.twig';
            default:
                return 'formulario_dinamico/_field_label.html.twig';
        }
    }

    public function getTemplateByFieldEntityValue($entityName, $attribute)
    {
        $fieldType = $this->loadDbEntityAttributeType($entityName, $attribute);

        switch ($fieldType) {
            case 'string':
                return 'formulario_dinamico/_field_text.html.twig';
            case 'blob':
                return 'formulario_dinamico/_field_textarea.html.twig';
            case 'date':
                return 'formulario_dinamico/_field_date.html.twig';
            default:
                return 'formulario_dinamico/_field_label.html.twig';
        }
    }
}
