<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211219100805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('DROP INDEX idx_5cecc7bea76ed395 ON address');
        $this->addSql('CREATE INDEX IDX_D4E6F81A76ED395 ON address (user_id)');
        $this->addSql('ALTER TABLE product ADD is_best TINYINT(1) NOT NULL, CHANGE category_id category_id INT NOT NULL, CHANGE illustration illustration VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395');
        $this->addSql('DROP INDEX idx_d4e6f81a76ed395 ON address');
        $this->addSql('CREATE INDEX IDX_5CECC7BEA76ED395 ON address (user_id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE product DROP is_best, CHANGE category_id category_id INT DEFAULT NULL, CHANGE illustration illustration VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
