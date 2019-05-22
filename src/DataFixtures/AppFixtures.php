<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 04/10/18
 * Time: 14:06.
 */

namespace App\DataFixtures;

use App\Entity\Aluno;
use App\Entity\Comentario;
use App\Entity\Educador;
use App\Entity\Escola;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; ++$i) {
            $user = new User();
            $user->setUsername('user'.$i);
            $user->setEmail('admin'.$i.'@admin.com');
            $password = $this->encoder->encodePassword($user, '103020');
            $user->setPassword($password);

            $escola = new Escola();
            $escola->setNome(EscolaNomeList::$list[$i]);
            $escola->setEndereco('Endereco Escola'.$i);

            $aluno = new Aluno();
            $aluno->setNome(AlunosNomeList::getRandomItem());
            $aluno->setEscola($escola);

            $aluna = new Aluno();
            $aluna->setNome(AlunosNomeList::getRandomItem());
            $aluna->setEscola($escola);

            $educador = new Educador();
            $educador->setAppUser($user);
            $educador->setNome('Educador '.$i);
            $educador->setEscola($escola);

            if ($i < 5) {
                $comenario = new Comentario();
                $comenario->setAluno($aluno);
                $comenario->setEducador($educador);
                $comenario->setDescricao('Comentario '.$i);
                //$comenario->setDataHora(new \DateTime());
            }

            $manager->persist($user);
            $manager->persist($escola);
            $manager->persist($aluno);
            $manager->persist($aluna);
            $manager->persist($educador);
            $manager->persist($comenario);
        }

        $manager->flush();
    }
}
