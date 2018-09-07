<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180906203116 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE qareview (id INT AUTO_INCREMENT NOT NULL, shipment_id INT NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_E09829537BE036FC (shipment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qaquestion (id INT AUTO_INCREMENT NOT NULL, question LONGTEXT NOT NULL, enable_comment TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qareview_answer (id INT AUTO_INCREMENT NOT NULL, review_id INT NOT NULL, question_id INT NOT NULL, rating INT DEFAULT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_2679279B3E2E969B (review_id), INDEX IDX_2679279B1E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE qareview ADD CONSTRAINT FK_E09829537BE036FC FOREIGN KEY (shipment_id) REFERENCES shipment (id)');
        $this->addSql('ALTER TABLE qareview_answer ADD CONSTRAINT FK_2679279B3E2E969B FOREIGN KEY (review_id) REFERENCES qareview (id)');
        $this->addSql('ALTER TABLE qareview_answer ADD CONSTRAINT FK_2679279B1E27F6BF FOREIGN KEY (question_id) REFERENCES qaquestion (id)');
        $this->addSql('ALTER TABLE status_update CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE status_group CHANGE code code VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE qareview_answer DROP FOREIGN KEY FK_2679279B3E2E969B');
        $this->addSql('ALTER TABLE qareview_answer DROP FOREIGN KEY FK_2679279B1E27F6BF');
        $this->addSql('DROP TABLE qareview');
        $this->addSql('DROP TABLE qaquestion');
        $this->addSql('DROP TABLE qareview_answer');
        $this->addSql('ALTER TABLE status_group CHANGE code code VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE status_update CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }
}
