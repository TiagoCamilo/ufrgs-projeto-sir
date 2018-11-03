<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181103153518 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE aluno ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE aluno ADD image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE aluno ADD image_original_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE aluno ADD image_mime_type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE aluno ADD image_size INT DEFAULT NULL');
        $this->addSql('ALTER TABLE aluno ADD image_dimensions TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN aluno.image_dimensions IS \'(DC2Type:simple_array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE aluno DROP updated_at');
        $this->addSql('ALTER TABLE aluno DROP image_name');
        $this->addSql('ALTER TABLE aluno DROP image_original_name');
        $this->addSql('ALTER TABLE aluno DROP image_mime_type');
        $this->addSql('ALTER TABLE aluno DROP image_size');
        $this->addSql('ALTER TABLE aluno DROP image_dimensions');
    }
}
