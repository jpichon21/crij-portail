<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190429092846 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE content_block ADD query_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE content_block ADD CONSTRAINT FK_68D8C3F0EF946F99 FOREIGN KEY (query_id) REFERENCES query (id)');
        $this->addSql('CREATE INDEX IDX_68D8C3F0EF946F99 ON content_block (query_id)');
        $this->addSql('ALTER TABLE content_block_audit ADD query_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE content_block DROP FOREIGN KEY FK_68D8C3F0EF946F99');
        $this->addSql('DROP INDEX IDX_68D8C3F0EF946F99 ON content_block');
        $this->addSql('ALTER TABLE content_block DROP query_id');
        $this->addSql('ALTER TABLE content_block_audit DROP query_id');
    }
}
