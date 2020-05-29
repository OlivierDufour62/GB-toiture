<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200528083743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE construction_site ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE construction_site ADD CONSTRAINT FK_BF4E61B49395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_BF4E61B49395C3F3 ON construction_site (customer_id)');
        $this->addSql('ALTER TABLE image ADD document_id INT DEFAULT NULL, ADD service_id INT NOT NULL, CHANGE construction_site_id construction_site_id INT NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FC33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FC33F7837 ON image (document_id)');
        $this->addSql('CREATE INDEX IDX_C53D045FED5CA9E6 ON image (service_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE construction_site DROP FOREIGN KEY FK_BF4E61B49395C3F3');
        $this->addSql('DROP INDEX IDX_BF4E61B49395C3F3 ON construction_site');
        $this->addSql('ALTER TABLE construction_site DROP customer_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FC33F7837');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FED5CA9E6');
        $this->addSql('DROP INDEX IDX_C53D045FC33F7837 ON image');
        $this->addSql('DROP INDEX IDX_C53D045FED5CA9E6 ON image');
        $this->addSql('ALTER TABLE image DROP document_id, DROP service_id, CHANGE construction_site_id construction_site_id INT DEFAULT NULL');
    }
}
