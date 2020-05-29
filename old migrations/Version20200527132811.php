<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200527132811 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE construction_site ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE contact ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE customer ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE document ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE image ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE service_document ADD is_active TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category DROP is_active');
        $this->addSql('ALTER TABLE construction_site DROP is_active');
        $this->addSql('ALTER TABLE contact DROP is_active');
        $this->addSql('ALTER TABLE customer DROP is_active');
        $this->addSql('ALTER TABLE document DROP is_active');
        $this->addSql('ALTER TABLE image DROP is_active');
        $this->addSql('ALTER TABLE service_document DROP is_active');
    }
}
