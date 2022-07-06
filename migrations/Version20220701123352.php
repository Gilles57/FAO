<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220701123352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte ADD COLUMN start_at  DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__poi AS SELECT id, nom, lat, lon, preferred FROM carte');
        $this->addSql('DROP TABLE carte');
        $this->addSql('CREATE TABLE carte (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, lat DOUBLE PRECISION NOT NULL, lon DOUBLE PRECISION NOT NULL, preferred BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO carte (id, nom, lat, lon, preferred) SELECT id, nom, lat, lon, preferred FROM __temp__poi');
        $this->addSql('DROP TABLE __temp__poi');
    }
}
