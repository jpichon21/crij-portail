<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190419155149 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, background_id INT DEFAULT NULL, section_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, introduction TINYTEXT DEFAULT NULL, content TINYTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, archived DATETIME DEFAULT NULL, published DATETIME DEFAULT NULL, unpublished DATETIME DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, INDEX IDX_23A0E66C93D69EA (background_id), INDEX IDX_23A0E66D823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66C93D69EA FOREIGN KEY (background_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('DROP TABLE news');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, background_id INT DEFAULT NULL, section_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, introduction TINYTEXT DEFAULT NULL COLLATE utf8_unicode_ci, content TINYTEXT DEFAULT NULL COLLATE utf8_unicode_ci, created DATETIME NOT NULL, updated DATETIME NOT NULL, archived DATETIME DEFAULT NULL, published DATETIME DEFAULT NULL, unpublished DATETIME DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, INDEX IDX_1DD39950C93D69EA (background_id), INDEX IDX_1DD39950D823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950C93D69EA FOREIGN KEY (background_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('DROP TABLE article');
    }
}
