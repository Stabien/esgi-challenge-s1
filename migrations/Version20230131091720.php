<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131091720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE admin_id_seq CASCADE');
        $this->addSql('DROP TABLE admin');
        $this->addSql('ALTER TABLE bet DROP CONSTRAINT fk_fbf0ec9b99b8cbc0');
        $this->addSql('DROP INDEX idx_fbf0ec9b99b8cbc0');
        $this->addSql('ALTER TABLE bet DROP uuid');
        $this->addSql('ALTER TABLE bet RENAME COLUMN user_uuid_id TO user_id');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9BA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FBF0EC9BA76ED395 ON bet (user_id)');
        $this->addSql('ALTER TABLE matchs DROP CONSTRAINT fk_6b1e60414a9e27a9');
        $this->addSql('ALTER TABLE matchs DROP CONSTRAINT fk_6b1e604189dc449a');
        $this->addSql('ALTER TABLE matchs DROP CONSTRAINT fk_6b1e6041aa87bc92');
        $this->addSql('DROP INDEX idx_6b1e6041aa87bc92');
        $this->addSql('DROP INDEX idx_6b1e604189dc449a');
        $this->addSql('DROP INDEX idx_6b1e60414a9e27a9');
        $this->addSql('ALTER TABLE matchs ADD team_one_id INT NOT NULL');
        $this->addSql('ALTER TABLE matchs ADD team_two_id INT NOT NULL');
        $this->addSql('ALTER TABLE matchs DROP team_one_uuid_id');
        $this->addSql('ALTER TABLE matchs DROP team_two_uuid_id');
        $this->addSql('ALTER TABLE matchs DROP uuid');
        $this->addSql('ALTER TABLE matchs RENAME COLUMN team_winner_uuid_id TO team_winner_id');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E60418D8189CA FOREIGN KEY (team_one_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041E6DD6E05 FOREIGN KEY (team_two_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E6041EAF9CA5F FOREIGN KEY (team_winner_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6B1E60418D8189CA ON matchs (team_one_id)');
        $this->addSql('CREATE INDEX IDX_6B1E6041E6DD6E05 ON matchs (team_two_id)');
        $this->addSql('CREATE INDEX IDX_6B1E6041EAF9CA5F ON matchs (team_winner_id)');
        $this->addSql('ALTER TABLE team DROP uuid');
        $this->addSql('ALTER TABLE "user" DROP uuid');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE admin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, uuid UUID NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE bet DROP CONSTRAINT FK_FBF0EC9BA76ED395');
        $this->addSql('DROP INDEX IDX_FBF0EC9BA76ED395');
        $this->addSql('ALTER TABLE bet ADD uuid UUID NOT NULL');
        $this->addSql('ALTER TABLE bet RENAME COLUMN user_id TO user_uuid_id');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT fk_fbf0ec9b99b8cbc0 FOREIGN KEY (user_uuid_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_fbf0ec9b99b8cbc0 ON bet (user_uuid_id)');
        $this->addSql('ALTER TABLE matchs DROP CONSTRAINT FK_6B1E60418D8189CA');
        $this->addSql('ALTER TABLE matchs DROP CONSTRAINT FK_6B1E6041E6DD6E05');
        $this->addSql('ALTER TABLE matchs DROP CONSTRAINT FK_6B1E6041EAF9CA5F');
        $this->addSql('DROP INDEX IDX_6B1E60418D8189CA');
        $this->addSql('DROP INDEX IDX_6B1E6041E6DD6E05');
        $this->addSql('DROP INDEX IDX_6B1E6041EAF9CA5F');
        $this->addSql('ALTER TABLE matchs ADD team_one_uuid_id INT NOT NULL');
        $this->addSql('ALTER TABLE matchs ADD team_two_uuid_id INT NOT NULL');
        $this->addSql('ALTER TABLE matchs ADD uuid UUID NOT NULL');
        $this->addSql('ALTER TABLE matchs DROP team_one_id');
        $this->addSql('ALTER TABLE matchs DROP team_two_id');
        $this->addSql('ALTER TABLE matchs RENAME COLUMN team_winner_id TO team_winner_uuid_id');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT fk_6b1e60414a9e27a9 FOREIGN KEY (team_one_uuid_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT fk_6b1e604189dc449a FOREIGN KEY (team_two_uuid_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT fk_6b1e6041aa87bc92 FOREIGN KEY (team_winner_uuid_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_6b1e6041aa87bc92 ON matchs (team_winner_uuid_id)');
        $this->addSql('CREATE INDEX idx_6b1e604189dc449a ON matchs (team_two_uuid_id)');
        $this->addSql('CREATE INDEX idx_6b1e60414a9e27a9 ON matchs (team_one_uuid_id)');
        $this->addSql('ALTER TABLE "user" ADD uuid VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE team ADD uuid UUID NOT NULL');
    }
}
