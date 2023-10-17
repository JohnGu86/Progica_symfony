<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504064659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gite_equipement_exterieur (gite_id INT NOT NULL, equipement_exterieur_id INT NOT NULL, INDEX IDX_C00BDF79652CAE9B (gite_id), INDEX IDX_C00BDF79971079B8 (equipement_exterieur_id), PRIMARY KEY(gite_id, equipement_exterieur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite_equipement_interieur (gite_id INT NOT NULL, equipement_interieur_id INT NOT NULL, INDEX IDX_9CEB14C1652CAE9B (gite_id), INDEX IDX_9CEB14C1D4593AB1 (equipement_interieur_id), PRIMARY KEY(gite_id, equipement_interieur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gite_equipement_exterieur ADD CONSTRAINT FK_C00BDF79652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_equipement_exterieur ADD CONSTRAINT FK_C00BDF79971079B8 FOREIGN KEY (equipement_exterieur_id) REFERENCES equipement_exterieur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_equipement_interieur ADD CONSTRAINT FK_9CEB14C1652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_equipement_interieur ADD CONSTRAINT FK_9CEB14C1D4593AB1 FOREIGN KEY (equipement_interieur_id) REFERENCES equipement_interieur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite_equipement_exterieur DROP FOREIGN KEY FK_C00BDF79652CAE9B');
        $this->addSql('ALTER TABLE gite_equipement_exterieur DROP FOREIGN KEY FK_C00BDF79971079B8');
        $this->addSql('ALTER TABLE gite_equipement_interieur DROP FOREIGN KEY FK_9CEB14C1652CAE9B');
        $this->addSql('ALTER TABLE gite_equipement_interieur DROP FOREIGN KEY FK_9CEB14C1D4593AB1');
        $this->addSql('DROP TABLE gite_equipement_exterieur');
        $this->addSql('DROP TABLE gite_equipement_interieur');
    }
}
