<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131114752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE competition_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE news_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subscription_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE competition (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE news (id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE subscription (id INT NOT NULL, user_id_id INT NOT NULL, team_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A3C664D39D86650F ON subscription (user_id_id)');
        $this->addSql('CREATE INDEX IDX_A3C664D3296CD8AE ON subscription (team_id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D39D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE competition_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE news_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subscription_id_seq CASCADE');
        $this->addSql('ALTER TABLE subscription DROP CONSTRAINT FK_A3C664D39D86650F');
        $this->addSql('ALTER TABLE subscription DROP CONSTRAINT FK_A3C664D3296CD8AE');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE subscription');
    }
}
