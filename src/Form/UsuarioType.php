<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 14/10/18
 * Time: 10:17.
 */

namespace App\Form;

use App\Entity\Escola;
use App\Entity\Perfil;
use App\Entity\Usuario;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class UsuarioType extends AbstractType
{

    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('email', EmailType::class, ['label' => 'E-mail'])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'A senhas devem ser iguais.',
                'first_options'  => ['label' => 'Senha'],
                'second_options' => ['label' => 'Repetir Senha'],
                'required' => false
            ])
            ->add('nome', TextType::class)
            ->add('perfil', EntityType::class,[
                'class' => Perfil::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->where('p.id IN (2,3)')
                        ->orderBy('p.nome', 'DESC');
                },
                'choice_label' => 'nome',
            ]);

        if($this->user->getEscola() instanceof Escola) {
            $builder->add('escola', EntityType::class, [
                'class' => Escola::class,
                'choices' => [$this->user->getEscola()]
            ]);
        } else {
            $builder->add('escola', EntityType::class, [
                'class' => Escola::class,
                'required' => true
            ]);
        }


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
