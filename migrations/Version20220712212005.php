<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220712212005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_67F068BCBCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, categorie_id, message, prenom, age FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie_id INTEGER NOT NULL, message CLOB NOT NULL, prenom VARCHAR(255) NOT NULL, age INTEGER NOT NULL, CONSTRAINT FK_67F068BCBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaire (id, categorie_id, message, prenom, age) SELECT id, categorie_id, message, prenom, age FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BCBCF5E72D ON commentaire (categorie_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__partenaire AS SELECT id, nom, adresse, codepostal, ville, description FROM partenaire');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('CREATE TABLE partenaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(50) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, codepostal VARCHAR(10) DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, description CLOB DEFAULT NULL, entreprise VARCHAR(50) DEFAULT NULL, tel VARCHAR(20) DEFAULT NULL)');
        $this->addSql('INSERT INTO partenaire (id, nom, adresse, codepostal, ville, description) SELECT id, nom, adresse, codepostal, ville, description FROM __temp__partenaire');
        $this->addSql('DROP TABLE __temp__partenaire');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_67F068BCBCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, categorie_id, message, prenom, age FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie_id INTEGER NOT NULL, message CLOB NOT NULL, prenom VARCHAR(255) NOT NULL, age INTEGER NOT NULL)');
        $this->addSql('INSERT INTO commentaire (id, categorie_id, message, prenom, age) SELECT id, categorie_id, message, prenom, age FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BCBCF5E72D ON commentaire (categorie_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__partenaire AS SELECT id, nom, adresse, codepostal, ville, description FROM partenaire');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('CREATE TABLE partenaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, codepostal VARCHAR(10) DEFAULT NULL, ville VARCHAR(50) NOT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO partenaire (id, nom, adresse, codepostal, ville, description) SELECT id, nom, adresse, codepostal, ville, description FROM __temp__partenaire');
        $this->addSql('DROP TABLE __temp__partenaire');
    }
}
