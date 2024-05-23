<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523082132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unit ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C53A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DCBB0C53A76ED395 ON unit (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unit DROP FOREIGN KEY FK_DCBB0C53A76ED395');
        $this->addSql('DROP INDEX IDX_DCBB0C53A76ED395 ON unit');
        $this->addSql('ALTER TABLE unit DROP user_id');
    }
}
