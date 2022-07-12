<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220712210633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partenaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, codepostal VARCHAR(10) DEFAULT NULL, ville VARCHAR(50) NOT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__categorie AS SELECT id, nom FROM categorie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO categorie (id, nom) SELECT id, nom FROM __temp__categorie');
        $this->addSql('DROP TABLE __temp__categorie');
        $this->addSql('DROP INDEX IDX_67F068BCBCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, categorie_id, message, prenom, age FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie_id INTEGER NOT NULL, message CLOB NOT NULL, prenom VARCHAR(255) NOT NULL, age INTEGER NOT NULL, CONSTRAINT FK_67F068BCBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaire (id, categorie_id, message, prenom, age) SELECT id, categorie_id, message, prenom, age FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BCBCF5E72D ON commentaire (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('CREATE TEMPORARY TABLE __temp__categorie AS SELECT id, nom FROM categorie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO categorie (id, nom) SELECT id, nom FROM __temp__categorie');
        $this->addSql('DROP TABLE __temp__categorie');
        $this->addSql('DROP INDEX IDX_67F068BCBCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, categorie_id, message, prenom, age FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie_id INTEGER DEFAULT NULL, message CLOB DEFAULT NULL, prenom VARCHAR(255) NOT NULL, age INTEGER NOT NULL)');
        $this->addSql('INSERT INTO commentaire (id, categorie_id, message, prenom, age) SELECT id, categorie_id, message, prenom, age FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BCBCF5E72D ON commentaire (categorie_id)');
    }
}
