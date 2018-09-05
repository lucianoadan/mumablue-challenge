<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180905193128 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE status_update (id INT AUTO_INCREMENT NOT NULL, status_id INT NOT NULL, shipment_id INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_256F9D356BF700BD (status_id), INDEX IDX_256F9D357BE036FC (shipment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE status_update ADD CONSTRAINT FK_256F9D356BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE status_update ADD CONSTRAINT FK_256F9D357BE036FC FOREIGN KEY (shipment_id) REFERENCES shipment (id)');
        $this->addSql('DROP TABLE shipment_status');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shipment_status (shipment_id INT NOT NULL, status_id INT NOT NULL, INDEX IDX_DD30FFD97BE036FC (shipment_id), INDEX IDX_DD30FFD96BF700BD (status_id), PRIMARY KEY(shipment_id, status_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shipment_status ADD CONSTRAINT FK_DD30FFD96BF700BD FOREIGN KEY (status_id) REFERENCES status (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shipment_status ADD CONSTRAINT FK_DD30FFD97BE036FC FOREIGN KEY (shipment_id) REFERENCES shipment (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE status_update');
    }
}
