<?php

namespace App\Form;

use App\Entity\FormularioCampo;
use App\Service\FormularioDinamicoHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormularioCampoType extends AbstractType
{
    private $formularioDinamicoHelper;

    public function __construct(FormularioDinamicoHelper $formularioDinamicoHelper)
    {
        $this->formularioDinamicoHelper = $formularioDinamicoHelper;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo', ChoiceType::class, [
                'choices' => $this->formularioDinamicoHelper->getFieldList(),
            ])
            ->add('label')
            ->add('linha')
            ->add('coluna')
            ->add('ordem')
            ->add('altura')
            ->add('largura')
            ->add('formulario')
            ->add('agrupador')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormularioCampo::class,
        ]);
    }
}
