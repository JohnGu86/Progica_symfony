<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230503163919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite ADD prix_id INT NOT NULL');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92C944722F2 FOREIGN KEY (prix_id) REFERENCES prix (id)');
        $this->addSql('CREATE INDEX IDX_B638C92C944722F2 ON gite (prix_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92C944722F2');
        $this->addSql('DROP INDEX IDX_B638C92C944722F2 ON gite');
        $this->addSql('ALTER TABLE gite DROP prix_id');
    }
}
