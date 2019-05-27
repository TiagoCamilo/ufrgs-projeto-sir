<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190523175542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE parecer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE parecer (id INT NOT NULL, educador_id INT NOT NULL, aluno_id INT NOT NULL, data_hora TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, descricao BYTEA NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D1569DBF8BA890EA ON parecer (educador_id)');
        $this->addSql('CREATE INDEX IDX_D1569DBFB2DDF7F4 ON parecer (aluno_id)');
        $this->addSql('ALTER TABLE parecer ADD CONSTRAINT FK_D1569DBF8BA890EA FOREIGN KEY (educador_id) REFERENCES educador (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE parecer ADD CONSTRAINT FK_D1569DBFB2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES aluno (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE parecer_id_seq CASCADE');
        $this->addSql('DROP TABLE parecer');
    }
}
