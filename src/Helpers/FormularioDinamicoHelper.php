<?php

namespace App\Helpers;

use App\Repository\AlunoRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Query;
use Nette\Utils\DateTime;
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

        $qb = $this->em->createQueryBuilder();
        $register = $qb->select('e')
            ->from('App\Entity\\'.$entityName, 'e')
            ->where('e.id = :id')
            ->setParameter('id', $objReferencia->getId())
            ->getQuery()
            ->getOneOrNullResult();
        $x = "getIdade";

        //Buscando por um metodo ao inves de um atributo puro
        if(method_exists($register, $attribute)){
            $value = $register->$attribute();
        }else{
            $value = $register->$attribute ?? null;
        }

        return $this->normalizeValue($value);
    }

    private function loadDbEntityAttributeType($entityName, $attribute){
        $objReferencia = $this->getEntityReference($entityName);

        $metadata = $this->em->getClassMetadata(get_class($objReferencia));

        if(false === isset($metadata->fieldMappings[$attribute])){
            return null;
        }

        $field = $metadata->fieldMappings[$attribute];

        return $field["type"];
    }

    private function normalizeValue($value){

        if(is_resource($value)){
            return stream_get_contents($value);
        }

        if(is_object($value) && $value instanceof \DateTime){
            return $value->format('Y-m-d');
        }

        return $value;
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
            case 'blob':
                return 'formulario_dinamico/_field_textarea.html.twig';
            case 'date':
                return 'formulario_dinamico/_field_date.html.twig';
            default:
                return 'formulario_dinamico/_field_text.html.twig';
        }
    }
}
