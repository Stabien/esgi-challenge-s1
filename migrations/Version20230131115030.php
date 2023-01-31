<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131115030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matchs ADD competition_id INT NOT NULL');
        $this->addSql('ALTER TABLE matchs ADD CONSTRAINT FK_6B1E60417B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6B1E60417B39D312 ON matchs (competition_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE matchs DROP CONSTRAINT FK_6B1E60417B39D312');
        $this->addSql('DROP INDEX IDX_6B1E60417B39D312');
        $this->addSql('ALTER TABLE matchs DROP competition_id');
    }
}
