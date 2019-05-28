<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190528004600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE formulario_registro ADD educador_id INT NOT NULL');
        $this->addSql('ALTER TABLE formulario_registro ADD aluno_id INT NOT NULL');
        $this->addSql('ALTER TABLE formulario_registro ADD CONSTRAINT FK_CF48CD548BA890EA FOREIGN KEY (educador_id) REFERENCES educador (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE formulario_registro ADD CONSTRAINT FK_CF48CD54B2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES aluno (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CF48CD548BA890EA ON formulario_registro (educador_id)');
        $this->addSql('CREATE INDEX IDX_CF48CD54B2DDF7F4 ON formulario_registro (aluno_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE formulario_registro DROP CONSTRAINT FK_CF48CD548BA890EA');
        $this->addSql('ALTER TABLE formulario_registro DROP CONSTRAINT FK_CF48CD54B2DDF7F4');
        $this->addSql('DROP INDEX IDX_CF48CD548BA890EA');
        $this->addSql('DROP INDEX IDX_CF48CD54B2DDF7F4');
        $this->addSql('ALTER TABLE formulario_registro DROP educador_id');
        $this->addSql('ALTER TABLE formulario_registro DROP aluno_id');
    }
}
