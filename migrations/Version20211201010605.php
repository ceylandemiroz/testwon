<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211201010605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_sous_category DROP FOREIGN KEY FK_D4EF3166527FEED1');
        $this->addSql('ALTER TABLE sous_category_category DROP FOREIGN KEY FK_7013484D527FEED1');
        $this->addSql('DROP TABLE product_sous_category');
        $this->addSql('DROP TABLE sous_category');
        $this->addSql('DROP TABLE sous_category_category');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_sous_category (product_id INT NOT NULL, sous_category_id INT NOT NULL, INDEX IDX_D4EF3166527FEED1 (sous_category_id), INDEX IDX_D4EF31664584665A (product_id), PRIMARY KEY(product_id, sous_category_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sous_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sous_category_category (sous_category_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_7013484D12469DE2 (category_id), INDEX IDX_7013484D527FEED1 (sous_category_id), PRIMARY KEY(sous_category_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_sous_category ADD CONSTRAINT FK_D4EF31664584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_sous_category ADD CONSTRAINT FK_D4EF3166527FEED1 FOREIGN KEY (sous_category_id) REFERENCES sous_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sous_category_category ADD CONSTRAINT FK_7013484D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sous_category_category ADD CONSTRAINT FK_7013484D527FEED1 FOREIGN KEY (sous_category_id) REFERENCES sous_category (id) ON DELETE CASCADE');
    }
}
