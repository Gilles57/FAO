<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220915154613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__point AS SELECT id, nom, lat, lon, preferred, start_at, end_at FROM point');
        $this->addSql('DROP TABLE point');
        $this->addSql('CREATE TABLE point (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, lat DOUBLE PRECISION NOT NULL, lon DOUBLE PRECISION NOT NULL, preferred BOOLEAN NOT NULL, begin_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , end_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO point (id, nom, lat, lon, preferred, begin_at, end_at) SELECT id, nom, lat, lon, preferred, start_at, end_at FROM __temp__point');
        $this->addSql('DROP TABLE __temp__point');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__point AS SELECT id, nom, lat, lon, preferred, begin_at, end_at FROM point');
        $this->addSql('DROP TABLE point');
        $this->addSql('CREATE TABLE point (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, lat DOUBLE PRECISION NOT NULL, lon DOUBLE PRECISION NOT NULL, preferred BOOLEAN NOT NULL, start_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , end_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO point (id, nom, lat, lon, preferred, start_at, end_at) SELECT id, nom, lat, lon, preferred, begin_at, end_at FROM __temp__point');
        $this->addSql('DROP TABLE __temp__point');
    }
}
