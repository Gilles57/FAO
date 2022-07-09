<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220709113046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference VARCHAR(255) NOT NULL, published_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , media VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) )');
        $this->addSql('DROP TABLE presse');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, message, prenom, age FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie_id INTEGER , message CLOB , prenom VARCHAR(255) NOT NULL, age INTEGER NOT NULL, CONSTRAINT FK_67F068BCBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaire (id, message, prenom, age) SELECT id, message, prenom, age FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BCBCF5E72D ON commentaire (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE presse (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference VARCHAR(255) NOT NULL COLLATE BINARY, published_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , media VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP INDEX IDX_67F068BCBCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, message, prenom, age FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, message CLOB NOT NULL, prenom VARCHAR(255) NOT NULL, age INTEGER NOT NULL)');
        $this->addSql('INSERT INTO commentaire (id, message, prenom, age) SELECT id, message, prenom, age FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
    }
}
