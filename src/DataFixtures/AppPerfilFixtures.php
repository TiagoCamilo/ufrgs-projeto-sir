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
        $manager->persist($this->buildPerfilControleAcao($perfil, 'escola_list'));
        $manager->persist($this->buildPerfilControleAcao($perfil, 'aluno_list'));
        $manager->persist($this->buildPerfilControleAcao($perfil, 'comentario_list'));
        $manager->persist($this->buildPerfilControleAcao($perfil, 'acompanhamento_list'));
        $manager->persist($this->buildPerfilControleAcao($perfil, 'parecer_list'));
        $manager->persist($this->buildPerfilControleAcao($perfil, 'formulario_modelo_list'));
        $manager->persist($this->buildPerfilControleAcao($perfil, 'formulario_agrupador_list'));
        $manager->persist($this->buildPerfilControleAcao($perfil, 'formulario_campo_list'));
        $manager->persist($this->buildPerfilControleAcao($perfil, 'formulario_list'));


        $perfilEducador = new Perfil();
        $perfilEducador->setNome('Educador');

        $manager->persist($perfilEducador);
        $manager->persist($this->buildPerfilControleAcao($perfilEducador, 'aluno_list'));
        $manager->persist($this->buildPerfilControleAcao($perfilEducador, 'comentario_list'));
        $manager->persist($this->buildPerfilControleAcao($perfilEducador, 'acompanhamento_list'));
        $manager->persist($this->buildPerfilControleAcao($perfilEducador, 'parecer_list'));
        $manager->persist($this->buildPerfilControleAcao($perfilEducador, 'formulario_list'));
        $manager->flush();
    }

    private function buildPerfilControleAcao(Perfil $perfil, string $controleAcao): PerfilControleAcao
    {
        return new PerfilControleAcao($perfil, $this->listPerfilControleAcao[$controleAcao][0], $this->listPerfilControleAcao[$controleAcao][1], $controleAcao);
    }

    private $listPerfilControleAcao = [
        'aluno_list' => ['Aluno', 'Listagem'],
        'aluno_view' => ['Aluno', 'Visualizar'],
        'aluno_new' => ['Aluno', 'Criar'],
        'aluno_delete' => ['Aluno', 'Deletar'],
        'aluno_edit' => ['Aluno', 'Editar'],
        'escola_list' => ['Escola', 'Listagem'],
        'escola_view' => ['Escola', 'Visualizar'],
        'escola_new' => ['Escola', 'Criar'],
        'escola_delete' => ['Escola', 'Deletar'],
        'escola_edit' => ['Escola', 'Editar'],
        'comentario_list' => ['Comentario', 'Listagem'],
        'comentario_view' => ['Comentario', 'Visualizar'],
        'comentario_new' => ['Comentario', 'Criar'],
        'comentario_delete' => ['Comentario', 'Deletar'],
        'comentario_edit' => ['Comentario', 'Editar'],
        'acompanhamento_list' => ['Acompanhamento', 'Listagem'],
        'acompanhamento_view' => ['Acompanhamento', 'Visualizar'],
        'acompanhamento_new' => ['Acompanhamento', 'Criar'],
        'acompanhamento_delete' => ['Acompanhamento', 'Deletar'],
        'acompanhamento_edit' => ['Acompanhamento', 'Editar'],
        'parecer_list' => ['Parecer', 'Listagem'],
        'parecer_view' => ['Parecer', 'Visualizar'],
        'parecer_new' => ['Parecer', 'Criar'],
        'parecer_delete' => ['Parecer', 'Deletar'],
        'parecer_edit' => ['Parecer', 'Editar'],
        'formulario_agrupador_list' => ['Formulario_agrupador', 'Listagem'],
        'formulario_agrupador_view' => ['Formulario_agrupador', 'Visualizar'],
        'formulario_agrupador_new' => ['Formulario_agrupador', 'Criar'],
        'formulario_agrupador_delete' => ['Formulario_agrupador', 'Deletar'],
        'formulario_agrupador_edit' => ['Formulario_agrupador', 'Editar'],
        'formulario_campo_list' => ['Formulario_campo', 'Listagem'],
        'formulario_campo_view' => ['Formulario_campo', 'Visualizar'],
        'formulario_campo_new' => ['Formulario_campo', 'Criar'],
        'formulario_campo_delete' => ['Formulario_campo', 'Deletar'],
        'formulario_campo_edit' => ['Formulario_campo', 'Editar'],
        'formulario_modelo_list' => ['Formulario_modelo', 'Listagem'],
        'formulario_modelo_view' => ['Formulario_modelo', 'Visualizar'],
        'formulario_modelo_new' => ['Formulario_modelo', 'Criar'],
        'formulario_modelo_delete' => ['Formulario_modelo', 'Deletar'],
        'formulario_modelo_edit' => ['Formulario_modelo', 'Editar'],
        'formulario_list' => ['Formulario', 'Listagem'],
        'formulario_view' => ['Formulario', 'Visualizar'],
        'formulario_new' => ['Formulario', 'Criar'],
        'formulario_delete' => ['Formulario', 'Deletar'],
        'formulario_edit' => ['Formulario', 'Editar'],
    ];
}
