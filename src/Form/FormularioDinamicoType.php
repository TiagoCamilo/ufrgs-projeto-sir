<?php

namespace App\Form;

use App\Entity\Formulario;
use App\Repository\FormularioRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/** TODO: Remover ou dar seguimento na classe
O problema atual é que o framework precisa resolver os get, has, set do attr e os mesmos não existem */
class FormularioDinamicoType extends AbstractType
{
    private $formularioRepository;

    public function __construct(FormularioRepository $formularioRepository)
    {
        $this->formularioRepository = $formularioRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class)
        ;

        $formulario = $this->formularioRepository->find(1);

        foreach ($formulario->getFormularioCampos() as $campo) {
            //$builder->add($campo->getId(), $this->getClass($campo->getTipo()));
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formulario::class,
        ]);
    }

    private function getClass($fieldType)
    {
        return 'Symfony\\Component\\Form\\Extension\\Core\\Type\\'.$fieldType;
    }
}
