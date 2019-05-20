<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190515213610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE formulario_campo ADD agrupador_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formulario_campo ADD CONSTRAINT FK_74E36F8FA8E5B9A8 FOREIGN KEY (agrupador_id) REFERENCES formulario_agrupador (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_74E36F8FA8E5B9A8 ON formulario_campo (agrupador_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE formulario_campo DROP CONSTRAINT FK_74E36F8FA8E5B9A8');
        $this->addSql('DROP INDEX IDX_74E36F8FA8E5B9A8');
        $this->addSql('ALTER TABLE formulario_campo DROP agrupador_id');
    }
}
