<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190803211732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE acompanhamento DROP CONSTRAINT fk_85a67198ba890ea');
        $this->addSql('DROP INDEX idx_85a67198ba890ea');
        $this->addSql('ALTER TABLE acompanhamento DROP educador_id');
        $this->addSql('ALTER TABLE parecer DROP CONSTRAINT fk_d1569dbf8ba890ea');
        $this->addSql('DROP INDEX idx_d1569dbf8ba890ea');
        $this->addSql('ALTER TABLE parecer DROP educador_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE acompanhamento ADD educador_id INT NOT NULL');
        $this->addSql('ALTER TABLE acompanhamento ADD CONSTRAINT fk_85a67198ba890ea FOREIGN KEY (educador_id) REFERENCES educador (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_85a67198ba890ea ON acompanhamento (educador_id)');
        $this->addSql('ALTER TABLE parecer ADD educador_id INT NOT NULL');
        $this->addSql('ALTER TABLE parecer ADD CONSTRAINT fk_d1569dbf8ba890ea FOREIGN KEY (educador_id) REFERENCES educador (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d1569dbf8ba890ea ON parecer (educador_id)');
    }
}
