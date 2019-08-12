<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190812225119 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE acompanhamento ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE acompanhamento ADD CONSTRAINT FK_85A6719DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_85A6719DB38439E ON acompanhamento (usuario_id)');
        $this->addSql('ALTER TABLE parecer ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE parecer ADD CONSTRAINT FK_D1569DBFDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D1569DBFDB38439E ON parecer (usuario_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE acompanhamento DROP CONSTRAINT FK_85A6719DB38439E');
        $this->addSql('DROP INDEX IDX_85A6719DB38439E');
        $this->addSql('ALTER TABLE acompanhamento DROP usuario_id');
        $this->addSql('ALTER TABLE parecer DROP CONSTRAINT FK_D1569DBFDB38439E');
        $this->addSql('DROP INDEX IDX_D1569DBFDB38439E');
        $this->addSql('ALTER TABLE parecer DROP usuario_id');
    }
}
