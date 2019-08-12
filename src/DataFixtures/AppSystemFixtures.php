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
use App\Entity\Escola;
use App\Entity\Usuario;
use App\Repository\PerfilRepository;
use App\Service\FormularioModelo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppSystemFixtures extends Fixture
{
    private $encoder;
    private $formularioModelo;
    private $perfilRepository;

    public function __construct(UserPasswordEncoderInterface $encoder, FormularioModelo $formularioModelo, PerfilRepository $perfilRepository)
    {
        $this->encoder = $encoder;
        $this->formularioModelo = $formularioModelo;
        $this->perfilRepository = $perfilRepository;

    }

    public function load(ObjectManager $manager)
    {
        $escola = new Escola();
        $escola->setNome(EscolaNomeList::$list[0]);
        $escola->setEndereco('Endereco Escola 0');

        for ($i = 0; $i < 10; ++$i) {
            $user = new Usuario();
            $user->setEmail('admin'.$i.'@admin.com');
            $password = $this->encoder->encodePassword($user, '103020');
            $user->setPassword($password);
            $user->setPerfil($this->perfilRepository->find(1));
            $user->setNome('Educador '.$i);
            $user->setEscola($escola);

            $aluno = new Aluno();
            $aluno->setNome(AlunosNomeList::getRandomItem());
            $aluno->setEscola($escola);

            $aluna = new Aluno();
            $aluna->setNome(AlunosNomeList::getRandomItem());
            $aluna->setEscola($escola);

            if ($i < 5) {
                $comentario = new Comentario();
                $comentario->setAluno($aluno);
                $comentario->setUsuario($user);
                $comentario->setDescricao('Comentario '.$i);
            }

            $manager->persist($user);
            $manager->persist($escola);
            $manager->persist($aluno);
            $manager->persist($aluna);
            $manager->persist($comentario);
        }
        $this->formularioModelo->createFormModels($escola);

        $manager->flush();
    }
}
