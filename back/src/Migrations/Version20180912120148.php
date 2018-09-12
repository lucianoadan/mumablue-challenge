<?php declare (strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180912120148 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shipment (id INT AUTO_INCREMENT NOT NULL, ship_to_addr_id INT NOT NULL, order_ref VARCHAR(255) NOT NULL, tracking_num VARCHAR(255) DEFAULT NULL, label_path VARCHAR(255) DEFAULT NULL, delivery_instructions VARCHAR(1000) DEFAULT NULL, created_at DATETIME NOT NULL, est_delivery_date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_2CB20DC43427FD5 (ship_to_addr_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, company_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, address2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, zip VARCHAR(10) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, INDEX IDX_D4E6F81F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_update (id INT AUTO_INCREMENT NOT NULL, status_id INT NOT NULL, shipment_id INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_256F9D356BF700BD (status_id), INDEX IDX_256F9D357BE036FC (shipment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qareview (id INT AUTO_INCREMENT NOT NULL, shipment_id INT NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_E09829537BE036FC (shipment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, status_group_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_7B00651C638E7E9F (status_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, color VARCHAR(7) DEFAULT NULL, icon VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(2) NOT NULL, name VARCHAR(255) NOT NULL, invoice TINYINT(1) NOT NULL, available_shipping TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qaquestion (id INT AUTO_INCREMENT NOT NULL, question LONGTEXT NOT NULL, enable_comment TINYINT(1) NOT NULL, enable_rating TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qareview_answer (id INT AUTO_INCREMENT NOT NULL, review_id INT NOT NULL, question_id INT NOT NULL, rating INT DEFAULT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_2679279B3E2E969B (review_id), INDEX IDX_2679279B1E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shipment ADD CONSTRAINT FK_2CB20DC43427FD5 FOREIGN KEY (ship_to_addr_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE status_update ADD CONSTRAINT FK_256F9D356BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE status_update ADD CONSTRAINT FK_256F9D357BE036FC FOREIGN KEY (shipment_id) REFERENCES shipment (id)');
        $this->addSql('ALTER TABLE qareview ADD CONSTRAINT FK_E09829537BE036FC FOREIGN KEY (shipment_id) REFERENCES shipment (id)');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651C638E7E9F FOREIGN KEY (status_group_id) REFERENCES status_group (id)');
        $this->addSql('ALTER TABLE qareview_answer ADD CONSTRAINT FK_2679279B3E2E969B FOREIGN KEY (review_id) REFERENCES qareview (id)');
        $this->addSql('ALTER TABLE qareview_answer ADD CONSTRAINT FK_2679279B1E27F6BF FOREIGN KEY (question_id) REFERENCES qaquestion (id)');

        $this->addSql('CREATE VIEW `vw_actual_statuses` AS SELECT distinct `s`.`id` AS `id`, `s`.`status_group_id` AS `status_group_id`, `s`.`code` AS `code`, `s`.`name` AS `name` FROM ((`shipment` `sh` join `status_update` `su`) join `status` `s`) where ((`su`.`shipment_id` = `sh`.`id`) and (`su`.`status_id` = `s`.`id`) and (`su`.`created_at` = (select max(`su2`.`created_at`) from `status_update` `su2` where (`su2`.`shipment_id` = `su`.`shipment_id`))))');
        $this->addSql('CREATE VIEW `vw_shipment_hdr` AS SELECT `sh`.`id` AS `id`, `sh`.`order_ref` AS `order_ref`, `s`.`id` AS `status_id`, `s`.`name` AS `status_code`, `s`.`name` AS `status_name`, `s`.`status_group_id` AS `status_group_id`, `sg`.`code` AS `status_group_code`, `sg`.`name` AS `status_group_name`, `sg`.`color` AS `status_group_color`, `su`.`created_at` AS `created_at` FROM (((`shipment` `sh` join `status` `s`) join `status_update` `su`) join `status_group` `sg`) where ((`su`.`shipment_id` = `sh`.`id`) and (`s`.`status_group_id` = `sg`.`id`) and (`su`.`status_id` = `s`.`id`) and (`su`.`created_at` = (select max(`su2`.`created_at`) from `status_update` `su2` where (`su2`.`shipment_id` = `su`.`shipment_id`)))) union select `sh`.`id` AS `id`,`sh`.`order_ref` AS `order_ref`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,NULL AS `NULL`,`sh`.`created_at` AS `created_at` from `shipment` `sh` where (not(exists(select `su`.`id` from `status_update` `su` where (`su`.`shipment_id` = `sh`.`id`)))) order by `created_at` desc');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE status_update DROP FOREIGN KEY FK_256F9D357BE036FC');
        $this->addSql('ALTER TABLE qareview DROP FOREIGN KEY FK_E09829537BE036FC');
        $this->addSql('ALTER TABLE shipment DROP FOREIGN KEY FK_2CB20DC43427FD5');
        $this->addSql('ALTER TABLE qareview_answer DROP FOREIGN KEY FK_2679279B3E2E969B');
        $this->addSql('ALTER TABLE status_update DROP FOREIGN KEY FK_256F9D356BF700BD');
        $this->addSql('ALTER TABLE status DROP FOREIGN KEY FK_7B00651C638E7E9F');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81F92F3E70');
        $this->addSql('ALTER TABLE qareview_answer DROP FOREIGN KEY FK_2679279B1E27F6BF');
        $this->addSql('DROP TABLE shipment');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE status_update');
        $this->addSql('DROP TABLE qareview');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE status_group');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE qaquestion');
        $this->addSql('DROP TABLE qareview_answer');
    }
}
