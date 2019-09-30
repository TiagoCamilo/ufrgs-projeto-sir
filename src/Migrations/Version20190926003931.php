<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926003931 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE formulario_campo ADD entidade_dado_mapeado_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formulario_campo ADD CONSTRAINT FK_74E36F8FEF4AB31 FOREIGN KEY (entidade_dado_mapeado_id) REFERENCES entidade_dado_mapeado (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_74E36F8FEF4AB31 ON formulario_campo (entidade_dado_mapeado_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE formulario_campo DROP CONSTRAINT FK_74E36F8FEF4AB31');
        $this->addSql('DROP INDEX IDX_74E36F8FEF4AB31');
        $this->addSql('ALTER TABLE formulario_campo DROP entidade_dado_mapeado_id');
    }
}
