<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190426065310 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE query_filter');
        $this->addSql('DROP TABLE query_filter_audit');
        $this->addSql('ALTER TABLE query ADD filters TINYTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE query_audit ADD filters TINYTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE query_filter (id INT AUTO_INCREMENT NOT NULL, query_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, field VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, value VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, position INT NOT NULL, INDEX IDX_A503C79EF946F99 (query_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE query_filter_audit (id INT NOT NULL, rev INT NOT NULL, name VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, field VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, value VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL COLLATE utf8_unicode_ci, position INT DEFAULT NULL, query_id INT DEFAULT NULL, INDEX rev_049340839b1adb9735bea42783cc5863_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE query_filter ADD CONSTRAINT FK_A503C79EF946F99 FOREIGN KEY (query_id) REFERENCES query (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE query DROP filters');
        $this->addSql('ALTER TABLE query_audit DROP filters');
    }
}
