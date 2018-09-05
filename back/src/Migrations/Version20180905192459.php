<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180905192459 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shipment_status (shipment_id INT NOT NULL, status_id INT NOT NULL, INDEX IDX_DD30FFD97BE036FC (shipment_id), INDEX IDX_DD30FFD96BF700BD (status_id), PRIMARY KEY(shipment_id, status_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(7) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, status_group_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_7B00651C638E7E9F (status_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shipment_status ADD CONSTRAINT FK_DD30FFD97BE036FC FOREIGN KEY (shipment_id) REFERENCES shipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shipment_status ADD CONSTRAINT FK_DD30FFD96BF700BD FOREIGN KEY (status_id) REFERENCES status (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651C638E7E9F FOREIGN KEY (status_group_id) REFERENCES status_group (id)');
        $this->addSql('DROP INDEX order_ref_UNIQUE ON shipment');
        $this->addSql('ALTER TABLE country CHANGE available_shipping available_shipping TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE address DROP vat, CHANGE company_name company_name VARCHAR(255) NOT NULL, CHANGE zip zip VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_D4E6F81F92F3E70 ON address (country_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE status DROP FOREIGN KEY FK_7B00651C638E7E9F');
        $this->addSql('ALTER TABLE shipment_status DROP FOREIGN KEY FK_DD30FFD96BF700BD');
        $this->addSql('DROP TABLE shipment_status');
        $this->addSql('DROP TABLE status_group');
        $this->addSql('DROP TABLE status');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81F92F3E70');
        $this->addSql('DROP INDEX IDX_D4E6F81F92F3E70 ON address');
        $this->addSql('ALTER TABLE address ADD vat VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE company_name company_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE zip zip VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE country CHANGE available_shipping available_shipping TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX order_ref_UNIQUE ON shipment (order_ref)');
    }
}
