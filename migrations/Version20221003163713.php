<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221003163713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coupure (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference VARCHAR(255) NOT NULL, published_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , media VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, media_name VARCHAR(255) NOT NULL, uploaded_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('DROP TABLE article');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference VARCHAR(255) NOT NULL COLLATE BINARY, published_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , media VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('DROP TABLE coupure');
        $this->addSql('DROP TABLE media');
    }
}
