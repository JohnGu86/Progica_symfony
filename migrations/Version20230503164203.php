<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230503164203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite ADD contact_id INT NOT NULL, ADD proprietaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92CE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92C76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)');
        $this->addSql('CREATE INDEX IDX_B638C92CE7A1254A ON gite (contact_id)');
        $this->addSql('CREATE INDEX IDX_B638C92C76C50E4A ON gite (proprietaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92CE7A1254A');
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92C76C50E4A');
        $this->addSql('DROP INDEX IDX_B638C92CE7A1254A ON gite');
        $this->addSql('DROP INDEX IDX_B638C92C76C50E4A ON gite');
        $this->addSql('ALTER TABLE gite DROP contact_id, DROP proprietaire_id');
    }
}
