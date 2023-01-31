<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131115538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subscription DROP CONSTRAINT fk_a3c664d39d86650f');
        $this->addSql('DROP INDEX idx_a3c664d39d86650f');
        $this->addSql('ALTER TABLE subscription RENAME COLUMN user_id_id TO user_id');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A3C664D3A76ED395 ON subscription (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE subscription DROP CONSTRAINT FK_A3C664D3A76ED395');
        $this->addSql('DROP INDEX IDX_A3C664D3A76ED395');
        $this->addSql('ALTER TABLE subscription RENAME COLUMN user_id TO user_id_id');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT fk_a3c664d39d86650f FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_a3c664d39d86650f ON subscription (user_id_id)');
    }
}
