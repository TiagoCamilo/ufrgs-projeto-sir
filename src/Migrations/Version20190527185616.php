<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190527185616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE formulario_campo DROP CONSTRAINT fk_74e36f8f41cfe234');
        $this->addSql('DROP INDEX idx_74e36f8f41cfe234');
        $this->addSql('ALTER TABLE formulario_campo DROP formulario_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE formulario_campo ADD formulario_id INT NOT NULL');
        $this->addSql('ALTER TABLE formulario_campo ADD CONSTRAINT fk_74e36f8f41cfe234 FOREIGN KEY (formulario_id) REFERENCES formulario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_74e36f8f41cfe234 ON formulario_campo (formulario_id)');
    }
}
