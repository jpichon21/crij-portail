<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190502084531 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE query DROP FOREIGN KEY FK_24BDB5EBBBDBD894');
        $this->addSql('DROP INDEX IDX_24BDB5EBBBDBD894 ON query');
        $this->addSql('ALTER TABLE query DROP contentBlock_id');
        $this->addSql('ALTER TABLE query_audit DROP contentBlock_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE query ADD contentBlock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE query ADD CONSTRAINT FK_24BDB5EBBBDBD894 FOREIGN KEY (contentBlock_id) REFERENCES content_block (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_24BDB5EBBBDBD894 ON query (contentBlock_id)');
        $this->addSql('ALTER TABLE query_audit ADD contentBlock_id INT DEFAULT NULL');
    }
}
