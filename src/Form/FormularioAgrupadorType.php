<?php

namespace App\Form;

use App\Entity\FormularioAgrupador;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormularioAgrupadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('ordem')
            ->add('subtitulo')
            ->add('coluna1')
            ->add('coluna2')
            ->add('coluna3')
            ->add('formulario')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormularioAgrupador::class,
        ]);
    }
}
