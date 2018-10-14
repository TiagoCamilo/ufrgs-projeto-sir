<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 14/10/18
 * Time: 10:17.
 */

namespace App\Form;

use App\Entity\Escola;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EscolaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('endereco');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Escola::class,
        ]);
    }
}
