<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221003185037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, rubrique_id, message, prenom, age, validate FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, rubrique_id INTEGER DEFAULT NULL, message CLOB NOT NULL, prenom VARCHAR(255) NOT NULL, age INTEGER DEFAULT NULL, validate BOOLEAN NOT NULL, CONSTRAINT FK_67F068BC3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaire (id, rubrique_id, message, prenom, age, validate) SELECT id, rubrique_id, message, prenom, age, validate FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC3BD38833 ON commentaire (rubrique_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, rubrique_id, message, prenom, age, validate FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, rubrique_id INTEGER NOT NULL, message CLOB NOT NULL, prenom VARCHAR(255) NOT NULL, age INTEGER DEFAULT NULL, validate BOOLEAN NOT NULL, CONSTRAINT FK_67F068BC3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaire (id, rubrique_id, message, prenom, age, validate) SELECT id, rubrique_id, message, prenom, age, validate FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC3BD38833 ON commentaire (rubrique_id)');
    }
}
