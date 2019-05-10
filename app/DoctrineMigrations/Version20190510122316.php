<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190510122316 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF12469DE2');
        $this->addSql('ALTER TABLE section CHANGE category_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE content_block DROP FOREIGN KEY FK_68D8C3F084A0A3ED');
        $this->addSql('ALTER TABLE content_block CHANGE content_id content_id INT NOT NULL');
        $this->addSql('ALTER TABLE content_block ADD CONSTRAINT FK_68D8C3F084A0A3ED FOREIGN KEY (content_id) REFERENCES content (id)');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9D823E37A');
        $this->addSql('ALTER TABLE content CHANGE section_id section_id INT NOT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9D823E37A');
        $this->addSql('ALTER TABLE content CHANGE section_id section_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE content_block DROP FOREIGN KEY FK_68D8C3F084A0A3ED');
        $this->addSql('ALTER TABLE content_block CHANGE content_id content_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE content_block ADD CONSTRAINT FK_68D8C3F084A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF12469DE2');
        $this->addSql('ALTER TABLE section CHANGE category_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE SET NULL');
    }
}
