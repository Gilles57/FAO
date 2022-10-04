<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004113832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement ADD COLUMN image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD COLUMN updated_at DATETIME NOT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__media AS SELECT id, media_name, uploaded_at FROM media');
        $this->addSql('DROP TABLE media');
        $this->addSql('CREATE TABLE media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, media_name VARCHAR(255) NOT NULL, uploaded_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO media (id, media_name, uploaded_at) SELECT id, media_name, uploaded_at FROM __temp__media');
        $this->addSql('DROP TABLE __temp__media');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__evenement AS SELECT id, rubrique_id, ville_id, preferred, begin_at, end_at, description FROM evenement');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('CREATE TABLE evenement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, rubrique_id INTEGER DEFAULT NULL, ville_id INTEGER DEFAULT NULL, preferred BOOLEAN NOT NULL, begin_at DATETIME DEFAULT NULL, end_at DATETIME DEFAULT NULL, description CLOB DEFAULT NULL, CONSTRAINT FK_B26681E3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B26681EA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO evenement (id, rubrique_id, ville_id, preferred, begin_at, end_at, description) SELECT id, rubrique_id, ville_id, preferred, begin_at, end_at, description FROM __temp__evenement');
        $this->addSql('DROP TABLE __temp__evenement');
        $this->addSql('CREATE INDEX IDX_B26681E3BD38833 ON evenement (rubrique_id)');
        $this->addSql('CREATE INDEX IDX_B26681EA73F0036 ON evenement (ville_id)');
        $this->addSql('ALTER TABLE media ADD COLUMN media_file VARCHAR(255) DEFAULT NULL');
    }
}
