<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181004191736 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE comentario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE comentario (id INT NOT NULL, educador_id INT NOT NULL, aluno_id INT NOT NULL, data_hora TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, descricao VARCHAR(250) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4B91E7028BA890EA ON comentario (educador_id)');
        $this->addSql('CREATE INDEX IDX_4B91E702B2DDF7F4 ON comentario (aluno_id)');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E7028BA890EA FOREIGN KEY (educador_id) REFERENCES educador (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E702B2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES aluno (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE comentario_id_seq CASCADE');
        $this->addSql('DROP TABLE comentario');
    }
}
