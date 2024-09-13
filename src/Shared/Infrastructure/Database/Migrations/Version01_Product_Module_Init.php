<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version01_Product_Module_Init extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creating table for Product module';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE description (print VARCHAR(255) DEFAULT NULL, density VARCHAR(255) DEFAULT NULL, compound VARCHAR(255) DEFAULT NULL, id BLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product (name VARCHAR(255) NOT NULL, article VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, image VARCHAR(255) DEFAULT NULL, image_tablet VARCHAR(255) DEFAULT NULL, image_mobile VARCHAR(255) DEFAULT NULL, id BLOB NOT NULL, description_id BLOB DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_D34A04ADD9F966B FOREIGN KEY (description_id) REFERENCES description (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04ADD9F966B ON product (description_id)');
        $this->addSql('CREATE TABLE product_size (product_id BLOB NOT NULL, size_id BLOB NOT NULL, PRIMARY KEY(product_id, size_id), CONSTRAINT FK_7A2806CB4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7A2806CB498DA827 FOREIGN KEY (size_id) REFERENCES size (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_7A2806CB4584665A ON product_size (product_id)');
        $this->addSql('CREATE INDEX IDX_7A2806CB498DA827 ON product_size (size_id)');
        $this->addSql('CREATE TABLE size (size VARCHAR(255) NOT NULL, id BLOB NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE description');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_size');
        $this->addSql('DROP TABLE size');
    }
}
