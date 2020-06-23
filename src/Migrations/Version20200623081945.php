<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200623081945 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FF229C21E');
        $this->addSql('DROP TABLE quote_request');
        $this->addSql('DROP INDEX IDX_C53D045FF229C21E ON image');
        $this->addSql('ALTER TABLE image DROP quote_request_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE quote_request (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, type_construction_site VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, additional_information VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_create DATETIME NOT NULL, date_update DATETIME NOT NULL, date_delete DATE DEFAULT NULL, is_active TINYINT(1) NOT NULL, is_read TINYINT(1) NOT NULL, INDEX IDX_D478271B12469DE2 (category_id), INDEX IDX_D478271B9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE quote_request ADD CONSTRAINT FK_D478271B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE quote_request ADD CONSTRAINT FK_D478271B9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE image ADD quote_request_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FF229C21E FOREIGN KEY (quote_request_id) REFERENCES quote_request (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FF229C21E ON image (quote_request_id)');
    }
}
