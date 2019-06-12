<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 04/10/18
 * Time: 14:06.
 */

namespace App\DataFixtures;

use App\Entity\Perfil;
use App\Entity\PerfilControleAcao;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppPerfilFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $perfil = new Perfil();
        $perfil->setNome('Administrador');

        $manager->persist($perfil);
        $manager->persist(new PerfilControleAcao($perfil, 'Aluno', 'Visualizar', 'aluno_show'));
        $manager->persist(new PerfilControleAcao($perfil, 'Aluno', 'Editar', 'aluno_edit'));
        $manager->persist(new PerfilControleAcao($perfil, 'Foto/Vídeo', 'Visualizar', 'comentario_edit'));

        $perfilProfessor = new Perfil();
        $perfilProfessor->setNome('Professor');

        $manager->persist($perfilProfessor);
        $manager->persist(new PerfilControleAcao($perfilProfessor, 'Aluno', 'Editar', 'aluno_edit'));

        $manager->flush();
    }
}
