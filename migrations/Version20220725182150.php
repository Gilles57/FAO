<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725182150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE carte');
        $this->addSql('DROP INDEX IDX_67F068BC3BD38833');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, rubrique_id, message, prenom, age, validate, created_at FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, rubrique_id INTEGER NOT NULL, message CLOB NOT NULL, prenom VARCHAR(255) NOT NULL, age INTEGER NOT NULL, validate BOOLEAN DEFAULT NULL, created_at DATETIME NOT NULL, CONSTRAINT FK_67F068BC3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaire (id, rubrique_id, message, prenom, age, validate, created_at) SELECT id, rubrique_id, message, prenom, age, validate, created_at FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC3BD38833 ON commentaire (rubrique_id)');
        $this->addSql('ALTER TABLE partenaire ADD COLUMN logo VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carte (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, lat DOUBLE PRECISION NOT NULL, lon DOUBLE PRECISION NOT NULL, preferred BOOLEAN NOT NULL, start_at DATETIME DEFAULT NULL)');
        $this->addSql('DROP INDEX IDX_67F068BC3BD38833');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, rubrique_id, message, prenom, age, validate, created_at FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, rubrique_id INTEGER NOT NULL, message CLOB NOT NULL, prenom VARCHAR(255) NOT NULL, age INTEGER NOT NULL, validate BOOLEAN DEFAULT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO commentaire (id, rubrique_id, message, prenom, age, validate, created_at) SELECT id, rubrique_id, message, prenom, age, validate, created_at FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC3BD38833 ON commentaire (rubrique_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__partenaire AS SELECT id, entreprise, nom, adresse, codepostal, ville, description, tel FROM partenaire');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('CREATE TABLE partenaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, entreprise VARCHAR(50) DEFAULT NULL, nom VARCHAR(50) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, codepostal VARCHAR(10) DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, description CLOB DEFAULT NULL, tel VARCHAR(20) DEFAULT NULL)');
        $this->addSql('INSERT INTO partenaire (id, entreprise, nom, adresse, codepostal, ville, description, tel) SELECT id, entreprise, nom, adresse, codepostal, ville, description, tel FROM __temp__partenaire');
        $this->addSql('DROP TABLE __temp__partenaire');
    }
}
