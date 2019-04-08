<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190407235135 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE formulario_registro_campo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE formulario_registro_campo (id INT NOT NULL, formulario_registro_id INT NOT NULL, formulario_campo_id INT NOT NULL, valor VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E1E61C12BA72332 ON formulario_registro_campo (formulario_registro_id)');
        $this->addSql('CREATE INDEX IDX_E1E61C12574E5D53 ON formulario_registro_campo (formulario_campo_id)');
        $this->addSql('ALTER TABLE formulario_registro_campo ADD CONSTRAINT FK_E1E61C12BA72332 FOREIGN KEY (formulario_registro_id) REFERENCES formulario_registro (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE formulario_registro_campo ADD CONSTRAINT FK_E1E61C12574E5D53 FOREIGN KEY (formulario_campo_id) REFERENCES formulario_campo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE formulario_registro_campo_id_seq CASCADE');
        $this->addSql('DROP TABLE formulario_registro_campo');
    }
}
