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
        // User
        $user = new User();
        $user->setUsername('user1');
        $user->setEmail('admin@admin.com');

        $password = $this->encoder->encodePassword($user, '103020');
        $user->setPassword($password);
        $manager->persist($user);

        // Alunos
        for ($i = 0; $i < 10; ++$i) {
            $escola = new Escola();
            $escola->setNome('Escola '.$i);
            $escola->setEndereco('Endereco Escola'.$i);

            $aluno = new Aluno();
            if ($i < 5) {
                $aluno->setNome('Aluno '.$i);
            } else {
                $aluno->setNome('Aluno Editado '.$i);
            }
            $aluno->setUpdatedAt(new \DateTime());

            $educador = new Educador();
            if (0 == $i) {
                $educador->setAppUser($user);
            }
            $educador->setNome('Educador '.$i);

            $comenario = new Comentario();
            $comenario->setAluno($aluno);
            $comenario->setEducador($educador);
            $comenario->setDescricao('Comentario '.$i);
            $comenario->setDataHora(new \DateTime('now'));

            $manager->persist($escola);
            $manager->persist($aluno);
            $manager->persist($educador);
            $manager->persist($comenario);
        }

        $manager->flush();
    }
}
