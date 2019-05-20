<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190517220836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE formulario_agrupador DROP subtitulo');
        $this->addSql('ALTER TABLE formulario_agrupador DROP coluna1');
        $this->addSql('ALTER TABLE formulario_agrupador DROP coluna2');
        $this->addSql('ALTER TABLE formulario_agrupador DROP coluna3');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE formulario_agrupador ADD subtitulo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE formulario_agrupador ADD coluna1 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE formulario_agrupador ADD coluna2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE formulario_agrupador ADD coluna3 VARCHAR(255) DEFAULT NULL');
    }
}
