<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190502114740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFC93D69EA');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFF98F144A');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFC93D69EA FOREIGN KEY (background_id) REFERENCES media (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFF98F144A FOREIGN KEY (logo_id) REFERENCES media (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66C93D69EA');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66C93D69EA FOREIGN KEY (background_id) REFERENCES media (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9C93D69EA');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9C93D69EA FOREIGN KEY (background_id) REFERENCES media (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66C93D69EA');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66C93D69EA FOREIGN KEY (background_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9C93D69EA');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9C93D69EA FOREIGN KEY (background_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFC93D69EA');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFF98F144A');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFC93D69EA FOREIGN KEY (background_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFF98F144A FOREIGN KEY (logo_id) REFERENCES media (id)');
    }
}
