<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221003094432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout des champs titre, image et imagefile';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement ADD COLUMN titre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD COLUMN image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD COLUMN image_file VARCHAR(255) DEFAULT NULL');
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
    }
}
