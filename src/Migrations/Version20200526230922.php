<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200526230922 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE date_create date_create DATETIME NOT NULL, CHANGE date_update date_update DATETIME NOT NULL');
        $this->addSql('ALTER TABLE construction_site CHANGE date_create date_create DATETIME NOT NULL, CHANGE date_update date_update DATETIME NOT NULL');
        $this->addSql('ALTER TABLE contact CHANGE date_create date_create DATETIME NOT NULL, CHANGE date_update date_update DATETIME NOT NULL');
        $this->addSql('ALTER TABLE customer CHANGE date_create date_create DATETIME NOT NULL, CHANGE date_update date_update DATETIME NOT NULL');
        $this->addSql('ALTER TABLE document CHANGE date_create date_create DATETIME NOT NULL, CHANGE date_update date_update DATETIME NOT NULL');
        $this->addSql('ALTER TABLE image CHANGE date_create date_create DATETIME NOT NULL, CHANGE date_update date_update DATETIME NOT NULL');
        $this->addSql('ALTER TABLE service ADD category_id INT NOT NULL, CHANGE date_create date_create DATETIME NOT NULL, CHANGE date_update date_update DATETIME NOT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD212469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD212469DE2 ON service (category_id)');
        $this->addSql('ALTER TABLE service_document CHANGE date_update date_update DATETIME NOT NULL, CHANGE date_create date_create DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE date_create date_create DATE NOT NULL, CHANGE date_update date_update DATE NOT NULL');
        $this->addSql('ALTER TABLE construction_site CHANGE date_create date_create DATE NOT NULL, CHANGE date_update date_update DATE NOT NULL');
        $this->addSql('ALTER TABLE contact CHANGE date_create date_create DATE NOT NULL, CHANGE date_update date_update DATE NOT NULL');
        $this->addSql('ALTER TABLE customer CHANGE date_create date_create DATE NOT NULL, CHANGE date_update date_update DATE NOT NULL');
        $this->addSql('ALTER TABLE document CHANGE date_create date_create DATE NOT NULL, CHANGE date_update date_update DATE NOT NULL');
        $this->addSql('ALTER TABLE image CHANGE date_create date_create DATE NOT NULL, CHANGE date_update date_update DATE NOT NULL');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD212469DE2');
        $this->addSql('DROP INDEX IDX_E19D9AD212469DE2 ON service');
        $this->addSql('ALTER TABLE service DROP category_id, CHANGE date_create date_create DATE NOT NULL, CHANGE date_update date_update DATE NOT NULL');
        $this->addSql('ALTER TABLE service_document CHANGE date_create date_create DATE NOT NULL, CHANGE date_update date_update DATE NOT NULL');
    }
}
