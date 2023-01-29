<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230129173551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE admin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE bet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE matchs_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, uuid UUID NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE bet (id INT NOT NULL, user_uuid_id INT NOT NULL, uuid UUID NOT NULL, amount DOUBLE PRECISION NOT NULL, status INT NOT NULL, earnings DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FBF0EC9B99B8CBC0 ON bet (user_uuid_id)');
        $this->addSql('CREATE TABLE matchs (id INT NOT NULL, team_one_uuid_id INT NOT NULL, team_two_uuid_id INT NOT NULL, team_winner_uuid_id INT DEFAULT NULL, uuid UUID NOT NULL, best_of INT NOT NULL, team_one_rating DOUBLE PRECISION NOT NULL, team_two_rating DOUBLE PRECISION NOT NULL, team_one_score INT NOT NULL, team_two_score INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6B1E60414A9E27A9 ON matchs (team_one_uuid_id)');
        $this->addSql('CREATE INDEX IDX_6B1E604189DC449A ON matchs (team_two_uuid_id)');
        $this->addSql('CREATE INDEX IDX_6B1E6041AA87BC92 ON matchs (team_winner_uuid_id)');
        $this->addSql('CREATE TABLE team (id INT NOT NULL, uuid UUID NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, uuid VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, credit_card_number VARCHAR(255) DEFAULT NULL, credit_card_expiration VARCHAR(255) DEFAULT NULL, credit_card_secret VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
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
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9B99B8CBC0 FOREIGN KEY (user_uuid_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E60414A9E27A9 FOREIGN KEY (team_one_uuid_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E604189DC449A FOREIGN KEY (team_two_uuid_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041AA87BC92 FOREIGN KEY (team_winner_uuid_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE admin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE bet_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE matchs_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE bet DROP CONSTRAINT FK_FBF0EC9B99B8CBC0');
        $this->addSql('ALTER TABLE matchs DROP CONSTRAINT FK_6B1E60414A9E27A9');
        $this->addSql('ALTER TABLE matchs DROP CONSTRAINT FK_6B1E604189DC449A');
        $this->addSql('ALTER TABLE matchs DROP CONSTRAINT FK_6B1E6041AA87BC92');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE bet');
        $this->addSql('DROP TABLE matchs');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
