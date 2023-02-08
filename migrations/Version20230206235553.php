<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230206235553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bet ADD match_id INT NOT NULL');
        $this->addSql('ALTER TABLE bet ADD CONSTRAINT FK_FBF0EC9B2ABEACD6 FOREIGN KEY (match_id) REFERENCES matchs (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FBF0EC9B2ABEACD6 ON bet (match_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bet DROP CONSTRAINT FK_FBF0EC9B2ABEACD6');
        $this->addSql('DROP INDEX IDX_FBF0EC9B2ABEACD6');
        $this->addSql('ALTER TABLE bet DROP match_id');
    }
}
