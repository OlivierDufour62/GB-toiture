<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200623082849 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE material_document (id INT AUTO_INCREMENT NOT NULL, document_id INT DEFAULT NULL, material_id INT DEFAULT NULL, date_create DATETIME NOT NULL, date_update DATETIME NOT NULL, date_delete DATE DEFAULT NULL, INDEX IDX_9EB1AED4C33F7837 (document_id), INDEX IDX_9EB1AED4E308AC6F (material_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materials (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, unity VARCHAR(255) NOT NULL, quantity INT NOT NULL, date_create DATETIME NOT NULL, date_update DATETIME NOT NULL, date_delete DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE material_document ADD CONSTRAINT FK_9EB1AED4C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE material_document ADD CONSTRAINT FK_9EB1AED4E308AC6F FOREIGN KEY (material_id) REFERENCES materials (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE material_document DROP FOREIGN KEY FK_9EB1AED4E308AC6F');
        $this->addSql('DROP TABLE material_document');
        $this->addSql('DROP TABLE materials');
    }
}
