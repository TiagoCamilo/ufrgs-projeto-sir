<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190527164656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE formulario ADD escola_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formulario ADD CONSTRAINT FK_24D6FBDD786BBC9 FOREIGN KEY (escola_id) REFERENCES escola (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_24D6FBDD786BBC9 ON formulario (escola_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE formulario DROP CONSTRAINT FK_24D6FBDD786BBC9');
        $this->addSql('DROP INDEX IDX_24D6FBDD786BBC9');
        $this->addSql('ALTER TABLE formulario DROP escola_id');
    }
}
