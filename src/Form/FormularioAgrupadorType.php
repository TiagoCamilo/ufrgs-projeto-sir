<?php

namespace App\Form;

use App\Entity\Escola;
use App\Entity\Formulario;
use App\Entity\FormularioAgrupador;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;


class FormularioAgrupadorType extends AbstractType
{
    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('ordem');

        if($this->user->getEscola() instanceof Escola) {
            $builder->add('formulario', EntityType::class, [
                'class' => Formulario::class,
                'choices' => $this->user->getEscola()->getFormularios(),
            ]);
        } else {
            $builder->add('formulario');
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormularioAgrupador::class,
        ]);
    }
}
