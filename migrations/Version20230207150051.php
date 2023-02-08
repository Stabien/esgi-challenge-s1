<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230207150051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team ADD region_id INT NOT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F98260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C4E0A61F98260155 ON team (region_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE team DROP CONSTRAINT FK_C4E0A61F98260155');
        $this->addSql('DROP INDEX IDX_C4E0A61F98260155');
        $this->addSql('ALTER TABLE team DROP region_id');
    }
}
