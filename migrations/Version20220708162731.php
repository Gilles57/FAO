<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220708162731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, contenu FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, message CLOB NOT NULL, prenom VARCHAR(255) NOT NULL, age INTEGER NOT NULL)');
        $this->addSql('INSERT INTO commentaire (id, message) SELECT id, contenu FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, message, prenom FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contenu CLOB NOT NULL, titre VARCHAR(255) NOT NULL, signature VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO commentaire (id, contenu, titre) SELECT id, message, prenom FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
    }
}
