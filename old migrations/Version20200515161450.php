<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200515161450 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date_create DATE NOT NULL, date_update DATE NOT NULL, date_delete DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE construction_site (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date_create DATE NOT NULL, date_update DATE NOT NULL, date_delete DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phonenumber VARCHAR(255) NOT NULL, date_create DATE NOT NULL, date_update DATE NOT NULL, date_delete DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phonenumber VARCHAR(255) NOT NULL, addres_one VARCHAR(255) NOT NULL, address_two VARCHAR(255) NOT NULL, zipcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, date_create DATE NOT NULL, date_update DATE NOT NULL, date_delete DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, type TINYINT(1) NOT NULL, date_create DATE NOT NULL, date_update DATE NOT NULL, date_delete DATE DEFAULT NULL, INDEX IDX_D8698A7619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, construction_site_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date_create DATE NOT NULL, date_update DATE NOT NULL, date_delete DATE DEFAULT NULL, INDEX IDX_C53D045F4994A532 (construction_site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, rate VARCHAR(255) NOT NULL, date_create DATE NOT NULL, date_update DATE NOT NULL, date_delete DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_document (id INT AUTO_INCREMENT NOT NULL, document_id INT NOT NULL, date_update DATE NOT NULL, date_create DATE NOT NULL, date_delete DATE DEFAULT NULL, INDEX IDX_211FD14BC33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7619EB6921 FOREIGN KEY (client_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4994A532 FOREIGN KEY (construction_site_id) REFERENCES construction_site (id)');
        $this->addSql('ALTER TABLE service_document ADD CONSTRAINT FK_211FD14BC33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4994A532');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7619EB6921');
        $this->addSql('ALTER TABLE service_document DROP FOREIGN KEY FK_211FD14BC33F7837');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE construction_site');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_document');
    }
}
