<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181111212943 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE educador ADD escola_id INT NOT NULL');
        $this->addSql('ALTER TABLE educador ADD CONSTRAINT FK_97871C4DD786BBC9 FOREIGN KEY (escola_id) REFERENCES escola (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_97871C4DD786BBC9 ON educador (escola_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE educador DROP CONSTRAINT FK_97871C4DD786BBC9');
        $this->addSql('DROP INDEX IDX_97871C4DD786BBC9');
        $this->addSql('ALTER TABLE educador DROP escola_id');
    }
}
