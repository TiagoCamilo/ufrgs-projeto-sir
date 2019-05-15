<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190515204246 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE formulario_agrupador_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE formulario_agrupador (id INT NOT NULL, formulario_id INT NOT NULL, titulo VARCHAR(255) NOT NULL, subtitulo VARCHAR(255) DEFAULT NULL, coluna1 VARCHAR(255) DEFAULT NULL, coluna2 VARCHAR(255) DEFAULT NULL, coluna3 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AE96284241CFE234 ON formulario_agrupador (formulario_id)');
        $this->addSql('ALTER TABLE formulario_agrupador ADD CONSTRAINT FK_AE96284241CFE234 FOREIGN KEY (formulario_id) REFERENCES formulario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE formulario_agrupador_id_seq CASCADE');
        $this->addSql('DROP TABLE formulario_agrupador');
    }
}
