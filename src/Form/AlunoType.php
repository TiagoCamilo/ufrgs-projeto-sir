<?php

namespace App\Form;

use App\Entity\Aluno;
use App\Entity\Escola;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlunoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('dataNascimento', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('turma')
            ->add('matricula', TextType::class, ['label'=> 'Matrícula', 'required'=> false])
            ->add('nomeMae', TextType::class, ['label'=> 'Nome mãe', 'required'=> false])
            ->add('nomePai')
            ->add('escola', EntityType::class,
                [
                    'class' => Escola::class,
                    'empty_data' => 2,
                ])
            ->add('historicoEscolar', TextareaType::class,
                [
                    'label' => 'Histórico',
                    'required' => false,
                    'attr' => ['rows' => 7],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Aluno::class,
        ]);
    }
}
