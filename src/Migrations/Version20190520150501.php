<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190520150501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE formulario_registro ADD formulario_id INT NOT NULL');
        $this->addSql('ALTER TABLE formulario_registro ADD CONSTRAINT FK_CF48CD5441CFE234 FOREIGN KEY (formulario_id) REFERENCES formulario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CF48CD5441CFE234 ON formulario_registro (formulario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE formulario_registro DROP CONSTRAINT FK_CF48CD5441CFE234');
        $this->addSql('DROP INDEX IDX_CF48CD5441CFE234');
        $this->addSql('ALTER TABLE formulario_registro DROP formulario_id');
    }
}
