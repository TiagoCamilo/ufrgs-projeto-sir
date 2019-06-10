<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190610171241 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE perfil_controle_acao_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE perfil_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE perfil_controle_acao (id INT NOT NULL, perfil_id INT NOT NULL, controle VARCHAR(255) NOT NULL, acao VARCHAR(255) NOT NULL, route VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1AFF7FE857291544 ON perfil_controle_acao (perfil_id)');
        $this->addSql('CREATE TABLE perfil (id INT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE perfil_controle_acao ADD CONSTRAINT FK_1AFF7FE857291544 FOREIGN KEY (perfil_id) REFERENCES perfil (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE perfil_controle_acao DROP CONSTRAINT FK_1AFF7FE857291544');
        $this->addSql('DROP SEQUENCE perfil_controle_acao_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE perfil_id_seq CASCADE');
        $this->addSql('DROP TABLE perfil_controle_acao');
        $this->addSql('DROP TABLE perfil');
    }
}
