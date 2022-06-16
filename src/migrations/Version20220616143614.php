<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616143614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attraction ADD type VARCHAR(255) NOT NULL, ADD longitude VARCHAR(255) DEFAULT NULL, ADD latitude VARCHAR(255) DEFAULT NULL, ADD organizer VARCHAR(255) DEFAULT NULL, ADD start_date_time DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD end_datetime DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attraction DROP type, DROP longitude, DROP latitude, DROP organizer, DROP start_date_time, DROP end_datetime');
    }
}
