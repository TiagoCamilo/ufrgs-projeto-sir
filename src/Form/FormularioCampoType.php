<?php

namespace App\Form;

use App\Entity\Escola;
use App\Entity\FormularioAgrupador;
use App\Entity\FormularioCampo;
use App\Service\FormularioDinamico;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class FormularioCampoType extends AbstractType
{
    private $formularioDinamicoHelper;
    private $user;

    public function __construct(FormularioDinamico $formularioDinamicoHelper, Security $security)
    {
        $this->formularioDinamicoHelper = $formularioDinamicoHelper;
        $this->user = $security->getUser();
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
            ->add('largura');

        if ($this->user->getEscola() instanceof Escola) {
            $builder->add('agrupador', EntityType::class, [
                'class' => FormularioAgrupador::class,
                'choices' => $this->user->getEscola()->getFormularios()->map(function ($formulario) {
                    return $formulario->getFormularioAgrupadores()->toArray();
                }),
            ]);
        } else {
            $builder->add('agrupador');
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormularioCampo::class,
        ]);
    }
}
