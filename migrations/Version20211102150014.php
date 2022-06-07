<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211102150014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sous_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_category_category (sous_category_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_7013484D527FEED1 (sous_category_id), INDEX IDX_7013484D12469DE2 (category_id), PRIMARY KEY(sous_category_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sous_category_category ADD CONSTRAINT FK_7013484D527FEED1 FOREIGN KEY (sous_category_id) REFERENCES sous_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sous_category_category ADD CONSTRAINT FK_7013484D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_category_category DROP FOREIGN KEY FK_7013484D527FEED1');
        $this->addSql('DROP TABLE sous_category');
        $this->addSql('DROP TABLE sous_category_category');
    }
}
