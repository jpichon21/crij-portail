<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190515061413 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_route DROP FOREIGN KEY FK_95DFAC964B89032C');
        $this->addSql('ALTER TABLE query_query_filter DROP FOREIGN KEY FK_27BFA0E025F9BEEE');
        $this->addSql('DROP TABLE content_block_query');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_route');
        $this->addSql('DROP TABLE query_filter');
        $this->addSql('DROP TABLE query_query_filter');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE content_block_query (content_block_id INT NOT NULL, query_id INT NOT NULL, INDEX IDX_B086D98BEF946F99 (query_id), INDEX IDX_B086D98BBB5A68E3 (content_block_id), PRIMARY KEY(content_block_id, query_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, background_id INT DEFAULT NULL, section_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, introduction TINYTEXT DEFAULT NULL COLLATE utf8_unicode_ci, content TINYTEXT DEFAULT NULL COLLATE utf8_unicode_ci, created DATETIME NOT NULL, updated DATETIME NOT NULL, archived DATETIME DEFAULT NULL, published DATETIME DEFAULT NULL, unpublished DATETIME DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, INDEX IDX_1DD39950D823E37A (section_id), INDEX IDX_1DD39950C93D69EA (background_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post_route (post_id INT NOT NULL, route_id INT NOT NULL, INDEX IDX_95DFAC9634ECB4E6 (route_id), INDEX IDX_95DFAC964B89032C (post_id), PRIMARY KEY(post_id, route_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE query_filter (id INT AUTO_INCREMENT NOT NULL, entity VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, field VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, value VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE query_query_filter (query_id INT NOT NULL, query_filter_id INT NOT NULL, INDEX IDX_27BFA0E0EF946F99 (query_id), INDEX IDX_27BFA0E025F9BEEE (query_filter_id), PRIMARY KEY(query_id, query_filter_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE content_block_query ADD CONSTRAINT FK_B086D98BBB5A68E3 FOREIGN KEY (content_block_id) REFERENCES content_block (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_block_query ADD CONSTRAINT FK_B086D98BEF946F99 FOREIGN KEY (query_id) REFERENCES query (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950C93D69EA FOREIGN KEY (background_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE post_route ADD CONSTRAINT FK_95DFAC9634ECB4E6 FOREIGN KEY (route_id) REFERENCES orm_routes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_route ADD CONSTRAINT FK_95DFAC964B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE query_query_filter ADD CONSTRAINT FK_27BFA0E025F9BEEE FOREIGN KEY (query_filter_id) REFERENCES query_filter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE query_query_filter ADD CONSTRAINT FK_27BFA0E0EF946F99 FOREIGN KEY (query_id) REFERENCES query (id) ON DELETE CASCADE');
    }
}
