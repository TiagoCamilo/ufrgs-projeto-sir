<?php

namespace App\Form;

use App\Entity\Escola;
use App\Entity\Formulario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class FormularioType extends AbstractType
{
    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome');

        if($this->user->getEscola() instanceof Escola) {
            $builder->add('escola', EntityType::class, [
                'class' => Escola::class,
                'choices' => [$this->user->getEscola()]
            ]);
        } else {
            $builder->add('escola', null, ['placeholder' => 'MODELO']);

        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formulario::class,
        ]);
    }
}
