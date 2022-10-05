<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005135617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partenaire ADD COLUMN email VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__partenaire AS SELECT id, entreprise, nom, adresse, codepostal, ville, description, tel, logo FROM partenaire');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('CREATE TABLE partenaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, entreprise VARCHAR(50) DEFAULT NULL, nom VARCHAR(50) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, codepostal VARCHAR(10) DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, description CLOB DEFAULT NULL, tel VARCHAR(20) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO partenaire (id, entreprise, nom, adresse, codepostal, ville, description, tel, logo) SELECT id, entreprise, nom, adresse, codepostal, ville, description, tel, logo FROM __temp__partenaire');
        $this->addSql('DROP TABLE __temp__partenaire');
    }
}
