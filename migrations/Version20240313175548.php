<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313175548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE orders_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE "orders_order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT orders_pkey');
        $this->addSql('ALTER TABLE orders ADD order_id INT NOT NULL');
        $this->addSql('ALTER TABLE orders ADD customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE orders ADD date_order_placed TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE orders ADD order_status_code INT NOT NULL');
        $this->addSql('ALTER TABLE orders ADD order_details VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE orders DROP id');
        $this->addSql('ALTER TABLE orders DROP code');
        $this->addSql('COMMENT ON COLUMN orders.date_order_placed IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE orders ADD PRIMARY KEY (order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "orders_order_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE orders_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP INDEX orders_pkey');
        $this->addSql('ALTER TABLE "orders" ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE "orders" ADD code INT NOT NULL');
        $this->addSql('ALTER TABLE "orders" DROP order_id');
        $this->addSql('ALTER TABLE "orders" DROP customer_id');
        $this->addSql('ALTER TABLE "orders" DROP date_order_placed');
        $this->addSql('ALTER TABLE "orders" DROP order_status_code');
        $this->addSql('ALTER TABLE "orders" DROP order_details');
        $this->addSql('ALTER TABLE "orders" ADD PRIMARY KEY (id)');
    }
}
