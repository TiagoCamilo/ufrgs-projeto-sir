<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190514131848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE formulario_campo ADD linha SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE formulario_campo ADD coluna SMALLINT DEFAULT NULL');
        $this->addSql('DROP INDEX idx_unq_form_reg_cam_form_reg_form_camp');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE UNIQUE INDEX idx_unq_form_reg_cam_form_reg_form_camp ON formulario_registro_campo (formulario_registro_id, formulario_campo_id)');
        $this->addSql('ALTER TABLE formulario_campo DROP linha');
        $this->addSql('ALTER TABLE formulario_campo DROP coluna');
    }
}
