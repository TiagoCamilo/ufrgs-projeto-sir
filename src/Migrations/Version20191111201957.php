<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191111201957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Clear Table
        $this->addSql('DELETE FROM PERFIL_CONTROLE_ACAO');

        //Create Coordenador profile
        $this->addSql("INSERT INTO PERFIL(ID, NOME) VALUES (3, 'Coordenador') ON CONFLICT (ID) DO NOTHING");

        //Administrador
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Aluno','Listagem','aluno_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Aluno','Visualizar','aluno_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Aluno','Criar','aluno_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Aluno','Deletar','aluno_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Aluno','Editar','aluno_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Escola','Listagem','escola_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Escola','Visualizar','escola_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Escola','Criar','escola_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Escola','Deletar','escola_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Escola','Editar','escola_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Comentario','Listagem','comentario_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Comentario','Visualizar','comentario_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Comentario','Criar','comentario_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Comentario','Deletar','comentario_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Comentario','Editar','comentario_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Acompanhamento','Listagem','acompanhamento_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Acompanhamento','Visualizar','acompanhamento_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Acompanhamento','Criar','acompanhamento_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Acompanhamento','Deletar','acompanhamento_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Acompanhamento','Editar','acompanhamento_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Parecer','Listagem','parecer_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Parecer','Visualizar','parecer_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Parecer','Criar','parecer_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Parecer','Deletar','parecer_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Parecer','Editar','parecer_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_agrupador','Listagem','formulario_agrupador_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_agrupador','Visualizar','formulario_agrupador_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_agrupador','Criar','formulario_agrupador_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_agrupador','Deletar','formulario_agrupador_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_agrupador','Editar','formulario_agrupador_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_campo','Listagem','formulario_campo_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_campo','Visualizar','formulario_campo_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_campo','Criar','formulario_campo_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_campo','Deletar','formulario_campo_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_campo','Editar','formulario_campo_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_modelo','Listagem','formulario_modelo_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_modelo','Visualizar','formulario_modelo_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_modelo','Criar','formulario_modelo_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_modelo','Deletar','formulario_modelo_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario_modelo','Editar','formulario_modelo_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario','Listagem','formulario_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario','Visualizar','formulario_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario','Criar','formulario_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario','Deletar','formulario_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Formulario','Editar','formulario_edit');");

        //Coordenador de Escola
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Aluno','Listagem','aluno_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Aluno','Visualizar','aluno_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Aluno','Criar','aluno_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Aluno','Deletar','aluno_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Aluno','Editar','aluno_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Comentario','Listagem','comentario_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Comentario','Visualizar','comentario_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Comentario','Criar','comentario_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Comentario','Deletar','comentario_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Comentario','Editar','comentario_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Acompanhamento','Listagem','acompanhamento_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Acompanhamento','Visualizar','acompanhamento_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Acompanhamento','Criar','acompanhamento_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Acompanhamento','Deletar','acompanhamento_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Acompanhamento','Editar','acompanhamento_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Parecer','Listagem','parecer_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Parecer','Visualizar','parecer_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Parecer','Criar','parecer_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Parecer','Deletar','parecer_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Parecer','Editar','parecer_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_agrupador','Listagem','formulario_agrupador_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_agrupador','Visualizar','formulario_agrupador_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_agrupador','Criar','formulario_agrupador_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_agrupador','Deletar','formulario_agrupador_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_agrupador','Editar','formulario_agrupador_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_campo','Listagem','formulario_campo_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_campo','Visualizar','formulario_campo_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_campo','Criar','formulario_campo_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_campo','Deletar','formulario_campo_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_campo','Editar','formulario_campo_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_modelo','Listagem','formulario_modelo_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_modelo','Visualizar','formulario_modelo_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_modelo','Criar','formulario_modelo_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_modelo','Deletar','formulario_modelo_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario_modelo','Editar','formulario_modelo_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario','Listagem','formulario_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario','Visualizar','formulario_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario','Criar','formulario_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario','Deletar','formulario_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Formulario','Editar','formulario_edit');");

        //Educador
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Aluno','Visualizar','aluno_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Aluno','Criar','aluno_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Aluno','Editar','aluno_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Comentario','Visualizar','comentario_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Comentario','Criar','comentario_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Comentario','Deletar','comentario_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Comentario','Editar','comentario_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Acompanhamento','Visualizar','acompanhamento_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Acompanhamento','Criar','acompanhamento_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Acompanhamento','Deletar','acompanhamento_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Acompanhamento','Editar','acompanhamento_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Parecer','Visualizar','parecer_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Parecer','Criar','parecer_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Parecer','Deletar','parecer_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Parecer','Editar','parecer_edit');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Formulario','Visualizar','formulario_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Formulario','Criar','formulario_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Formulario','Deletar','formulario_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Formulario','Editar','formulario_edit');");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
    }
}
