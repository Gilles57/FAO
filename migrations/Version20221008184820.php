<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221008184820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE commentaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE coupure_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE evenement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE media_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE partenaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE post_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE projet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rubrique_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ville_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE commentaire (id INT NOT NULL, rubrique_id INT DEFAULT NULL, message TEXT NOT NULL, prenom VARCHAR(255) NOT NULL, age INT DEFAULT NULL, validate BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_67F068BC3BD38833 ON commentaire (rubrique_id)');
        $this->addSql('CREATE TABLE coupure (id INT NOT NULL, reference VARCHAR(255) NOT NULL, published_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, media VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN coupure.published_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE evenement (id INT NOT NULL, rubrique_id INT DEFAULT NULL, ville_id INT DEFAULT NULL, preferred BOOLEAN NOT NULL, begin_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, description TEXT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B26681E3BD38833 ON evenement (rubrique_id)');
        $this->addSql('CREATE INDEX IDX_B26681EA73F0036 ON evenement (ville_id)');
        $this->addSql('CREATE TABLE media (id INT NOT NULL, post_id INT DEFAULT NULL, media_name VARCHAR(255) NOT NULL, uploaded_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A2CA10C4B89032C ON media (post_id)');
        $this->addSql('COMMENT ON COLUMN media.uploaded_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE partenaire (id INT NOT NULL, entreprise VARCHAR(50) DEFAULT NULL, nom VARCHAR(50) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, codepostal VARCHAR(10) DEFAULT NULL, ville VARCHAR(50) DEFAULT NULL, description TEXT DEFAULT NULL, tel VARCHAR(20) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, site VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE post (id INT NOT NULL, titre VARCHAR(255) NOT NULL, contenu TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, published_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, slug VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE projet (id INT NOT NULL, titre VARCHAR(255) NOT NULL, description TEXT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rubrique (id INT NOT NULL, nom VARCHAR(255) NOT NULL, color VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, forename VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE ville (id INT NOT NULL, nom VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C4B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE commentaire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE coupure_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE evenement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE media_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE partenaire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE post_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE projet_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rubrique_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ville_id_seq CASCADE');
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BC3BD38833');
        $this->addSql('ALTER TABLE evenement DROP CONSTRAINT FK_B26681E3BD38833');
        $this->addSql('ALTER TABLE evenement DROP CONSTRAINT FK_B26681EA73F0036');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT FK_6A2CA10C4B89032C');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE coupure');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE rubrique');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
