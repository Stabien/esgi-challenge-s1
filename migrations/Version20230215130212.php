<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215130212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bet ADD team_id INT NOT NULL');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9B296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FBF0EC9B296CD8AE ON bet (team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bet DROP CONSTRAINT FK_FBF0EC9B296CD8AE');
        $this->addSql('DROP INDEX IDX_FBF0EC9B296CD8AE');
        $this->addSql('ALTER TABLE bet DROP team_id');
    }
}
