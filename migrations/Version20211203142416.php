<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211203142416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category_category');
        $this->addSql('ALTER TABLE category ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1727ACA70 ON category (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_category (category_source INT NOT NULL, category_target INT NOT NULL, INDEX IDX_B1369DBA5062B508 (category_source), INDEX IDX_B1369DBA4987E587 (category_target), PRIMARY KEY(category_source, category_target)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category_category ADD CONSTRAINT FK_B1369DBA4987E587 FOREIGN KEY (category_target) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_category ADD CONSTRAINT FK_B1369DBA5062B508 FOREIGN KEY (category_source) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('DROP INDEX IDX_64C19C1727ACA70 ON category');
        $this->addSql('ALTER TABLE category DROP parent_id');
    }
}
