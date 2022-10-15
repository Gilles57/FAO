<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221015155008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__coupure AS SELECT id, reference, published_at, coupure_name, created_at, updated_at FROM coupure');
        $this->addSql('DROP TABLE coupure');
        $this->addSql('CREATE TABLE coupure (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference VARCHAR(255) NOT NULL, published_at DATETIME DEFAULT NULL, coupure_name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO coupure (id, reference, published_at, coupure_name, created_at, updated_at) SELECT id, reference, published_at, coupure_name, created_at, updated_at FROM __temp__coupure');
        $this->addSql('DROP TABLE __temp__coupure');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__coupure AS SELECT id, reference, published_at, coupure_name, created_at, updated_at FROM coupure');
        $this->addSql('DROP TABLE coupure');
        $this->addSql('CREATE TABLE coupure (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference VARCHAR(255) NOT NULL, published_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , coupure_name VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO coupure (id, reference, published_at, coupure_name, created_at, updated_at) SELECT id, reference, published_at, coupure_name, created_at, updated_at FROM __temp__coupure');
        $this->addSql('DROP TABLE __temp__coupure');
    }
}
