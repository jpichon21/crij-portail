<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190425080657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE query_filter ADD position INT NOT NULL, DROP entity');
        $this->addSql('ALTER TABLE query_filter_audit ADD position INT DEFAULT NULL, DROP entity');
        $this->addSql('ALTER TABLE query ADD entity VARCHAR(255) NOT NULL, ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE query_audit ADD entity VARCHAR(255) DEFAULT NULL, ADD position INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE query DROP entity, DROP position');
        $this->addSql('ALTER TABLE query_audit DROP entity, DROP position');
        $this->addSql('ALTER TABLE query_filter ADD entity VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP position');
        $this->addSql('ALTER TABLE query_filter_audit ADD entity VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, DROP position');
    }
}
