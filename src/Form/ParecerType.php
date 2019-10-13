<?php

namespace App\Form;

use App\Entity\Parecer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParecerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', TextType::class, [
                'label' => 'Título'
            ])
            ->add('descricao', TextareaType::class, [
                'attr' => ['class' => 'ckeditor'],
                'label' => 'Descrição',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parecer::class,
        ]);
    }
}
