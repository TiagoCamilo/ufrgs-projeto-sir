<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181110220252 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE acompanhamento_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE acompanhamento (id INT NOT NULL, educador_id INT NOT NULL, aluno_id INT NOT NULL, data_hora TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, descricao BYTEA NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_85A67198BA890EA ON acompanhamento (educador_id)');
        $this->addSql('CREATE INDEX IDX_85A6719B2DDF7F4 ON acompanhamento (aluno_id)');
        $this->addSql('ALTER TABLE acompanhamento ADD CONSTRAINT FK_85A67198BA890EA FOREIGN KEY (educador_id) REFERENCES educador (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE acompanhamento ADD CONSTRAINT FK_85A6719B2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES aluno (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE acompanhamento_id_seq CASCADE');
        $this->addSql('DROP TABLE acompanhamento');
    }
}
