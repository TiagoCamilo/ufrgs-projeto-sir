<?php

namespace App\Form;

use App\Entity\FormularioCampo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormularioCampoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo', ChoiceType::class, [
                'choices' => [
                    'Texto' => 'TextType',
                    'Área de Texto' => 'TextareaType',
                ],
            ])
            ->add('label')
            ->add('linha')
            ->add('coluna')
            ->add('formulario')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormularioCampo::class,
        ]);
    }
}
