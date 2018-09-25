<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 25/09/18
 * Time: 13:10
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class AlunoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('idade')
            ->add('save',SubmitType::class);
    }

}