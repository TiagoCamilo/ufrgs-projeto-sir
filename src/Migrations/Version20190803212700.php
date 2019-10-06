<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190803212700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE educador_id_seq CASCADE');
        $this->addSql('DROP TABLE educador');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE educador_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE educador (id INT NOT NULL, escola_id INT NOT NULL, nome VARCHAR(200) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_97871c4dd786bbc9 ON educador (escola_id)');
        $this->addSql('ALTER TABLE educador ADD CONSTRAINT fk_97871c4dd786bbc9 FOREIGN KEY (escola_id) REFERENCES escola (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
