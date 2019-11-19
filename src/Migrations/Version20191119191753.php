<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191119191753 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Usuário','Listagem','usuario_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Usuário','Visualizar','usuario_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Usuário','Criar','usuario_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Usuário','Deletar','usuario_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),1,'Usuário','Editar','usuario_edit');");

        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Usuário','Listagem','usuario_list');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Usuário','Visualizar','usuario_show');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Usuário','Criar','usuario_new');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Usuário','Deletar','usuario_delete');");
        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),3,'Usuário','Editar','usuario_edit');");

        $this->addSql("INSERT INTO PERFIL_CONTROLE_ACAO(ID, PERFIL_ID, CONTROLE, ACAO, ROUTE) VALUES (nextval('perfil_controle_acao_id_seq'),2,'Usuário','Editar','usuario_edit');");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
    }
}
