<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 10/11/18
 * Time: 14:03.
 */

namespace App\Form;

use App\Entity\Aluno;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlunoFile extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, ['label' => 'Foto'])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Aluno::class,
        ]);
    }
}
