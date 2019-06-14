<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190614200227 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE educador DROP CONSTRAINT fk_97871c4d4a3353d8');
        $this->addSql('DROP SEQUENCE app_users_id_seq CASCADE');
        $this->addSql('DROP TABLE app_users');
        $this->addSql('DROP INDEX uniq_97871c4d4a3353d8');
        $this->addSql('ALTER TABLE educador DROP app_user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE app_users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE app_users (id INT NOT NULL, perfil_id INT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(254) NOT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_c2502824e7927c74 ON app_users (email)');
        $this->addSql('CREATE INDEX idx_c250282457291544 ON app_users (perfil_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_c2502824f85e0677 ON app_users (username)');
        $this->addSql('ALTER TABLE app_users ADD CONSTRAINT fk_c250282457291544 FOREIGN KEY (perfil_id) REFERENCES perfil (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE educador ADD app_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE educador ADD CONSTRAINT fk_97871c4d4a3353d8 FOREIGN KEY (app_user_id) REFERENCES app_users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_97871c4d4a3353d8 ON educador (app_user_id)');
    }
}
