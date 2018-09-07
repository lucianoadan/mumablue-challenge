<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180906222514 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shipment DROP FOREIGN KEY FK_2CB20DC3E2E969B');
        $this->addSql('DROP INDEX UNIQ_2CB20DC3E2E969B ON shipment');
        $this->addSql('ALTER TABLE shipment DROP review_id');
        $this->addSql('ALTER TABLE status_update DROP FOREIGN KEY FK_256F9D357BE036FC');
        $this->addSql('ALTER TABLE status_update ADD CONSTRAINT FK_256F9D357BE036FC FOREIGN KEY (shipment_id) REFERENCES shipment (id)');
        $this->addSql('ALTER TABLE qareview ADD shipment_id INT NOT NULL');
        $this->addSql('ALTER TABLE qareview ADD CONSTRAINT FK_E09829537BE036FC FOREIGN KEY (shipment_id) REFERENCES shipment (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E09829537BE036FC ON qareview (shipment_id)');
        $this->addSql('ALTER TABLE qareview_answer DROP FOREIGN KEY FK_2679279B3E2E969B');
        $this->addSql('ALTER TABLE qareview_answer ADD CONSTRAINT FK_2679279B3E2E969B FOREIGN KEY (review_id) REFERENCES qareview (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE qareview DROP FOREIGN KEY FK_E09829537BE036FC');
        $this->addSql('DROP INDEX UNIQ_E09829537BE036FC ON qareview');
        $this->addSql('ALTER TABLE qareview DROP shipment_id');
        $this->addSql('ALTER TABLE qareview_answer DROP FOREIGN KEY FK_2679279B3E2E969B');
        $this->addSql('ALTER TABLE qareview_answer ADD CONSTRAINT FK_2679279B3E2E969B FOREIGN KEY (review_id) REFERENCES qareview (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shipment ADD review_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shipment ADD CONSTRAINT FK_2CB20DC3E2E969B FOREIGN KEY (review_id) REFERENCES qareview (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2CB20DC3E2E969B ON shipment (review_id)');
        $this->addSql('ALTER TABLE status_update DROP FOREIGN KEY FK_256F9D357BE036FC');
        $this->addSql('ALTER TABLE status_update ADD CONSTRAINT FK_256F9D357BE036FC FOREIGN KEY (shipment_id) REFERENCES shipment (id) ON DELETE CASCADE');
    }
}
