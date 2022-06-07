<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211102162618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, illustration VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_sous_category (product_id INT NOT NULL, sous_category_id INT NOT NULL, INDEX IDX_D4EF31664584665A (product_id), INDEX IDX_D4EF3166527FEED1 (sous_category_id), PRIMARY KEY(product_id, sous_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_sous_category ADD CONSTRAINT FK_D4EF31664584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_sous_category ADD CONSTRAINT FK_D4EF3166527FEED1 FOREIGN KEY (sous_category_id) REFERENCES sous_category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_sous_category DROP FOREIGN KEY FK_D4EF31664584665A');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_sous_category');
    }
}
