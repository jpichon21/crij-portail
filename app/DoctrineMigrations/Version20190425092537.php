<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190425092537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE content_block_query');
        $this->addSql('DROP TABLE query_query_filter');
        $this->addSql('ALTER TABLE query_filter ADD query_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE query_filter ADD CONSTRAINT FK_A503C79EF946F99 FOREIGN KEY (query_id) REFERENCES query (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_A503C79EF946F99 ON query_filter (query_id)');
        $this->addSql('ALTER TABLE query_filter_audit ADD query_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE query ADD contentBlock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE query ADD CONSTRAINT FK_24BDB5EBBBDBD894 FOREIGN KEY (contentBlock_id) REFERENCES content_block (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_24BDB5EBBBDBD894 ON query (contentBlock_id)');
        $this->addSql('ALTER TABLE query_audit ADD contentBlock_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE content_block_query (content_block_id INT NOT NULL, query_id INT NOT NULL, INDEX IDX_B086D98BBB5A68E3 (content_block_id), INDEX IDX_B086D98BEF946F99 (query_id), PRIMARY KEY(content_block_id, query_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE query_query_filter (query_id INT NOT NULL, query_filter_id INT NOT NULL, INDEX IDX_27BFA0E0EF946F99 (query_id), INDEX IDX_27BFA0E025F9BEEE (query_filter_id), PRIMARY KEY(query_id, query_filter_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE content_block_query ADD CONSTRAINT FK_B086D98BBB5A68E3 FOREIGN KEY (content_block_id) REFERENCES content_block (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_block_query ADD CONSTRAINT FK_B086D98BEF946F99 FOREIGN KEY (query_id) REFERENCES query (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE query_query_filter ADD CONSTRAINT FK_27BFA0E025F9BEEE FOREIGN KEY (query_filter_id) REFERENCES query_filter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE query_query_filter ADD CONSTRAINT FK_27BFA0E0EF946F99 FOREIGN KEY (query_id) REFERENCES query (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE query DROP FOREIGN KEY FK_24BDB5EBBBDBD894');
        $this->addSql('DROP INDEX IDX_24BDB5EBBBDBD894 ON query');
        $this->addSql('ALTER TABLE query DROP contentBlock_id');
        $this->addSql('ALTER TABLE query_audit DROP contentBlock_id');
        $this->addSql('ALTER TABLE query_filter DROP FOREIGN KEY FK_A503C79EF946F99');
        $this->addSql('DROP INDEX IDX_A503C79EF946F99 ON query_filter');
        $this->addSql('ALTER TABLE query_filter DROP query_id');
        $this->addSql('ALTER TABLE query_filter_audit DROP query_id');
    }
}
