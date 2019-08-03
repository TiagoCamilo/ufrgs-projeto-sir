<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190803150203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE usuario ADD escola_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD nome VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DD786BBC9 FOREIGN KEY (escola_id) REFERENCES escola (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2265B05DD786BBC9 ON usuario (escola_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE usuario DROP CONSTRAINT FK_2265B05DD786BBC9');
        $this->addSql('DROP INDEX IDX_2265B05DD786BBC9');
        $this->addSql('ALTER TABLE usuario DROP escola_id');
        $this->addSql('ALTER TABLE usuario DROP nome');
    }
}
