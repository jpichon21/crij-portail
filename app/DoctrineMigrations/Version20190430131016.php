<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190430131016 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE activity_audit');
        $this->addSql('DROP TABLE article_audit');
        $this->addSql('DROP TABLE category_audit');
        $this->addSql('DROP TABLE content_audit');
        $this->addSql('DROP TABLE content_block_audit');
        $this->addSql('DROP TABLE media_audit');
        $this->addSql('DROP TABLE organism_audit');
        $this->addSql('DROP TABLE query_audit');
        $this->addSql('DROP TABLE revisions');
        $this->addSql('DROP TABLE section_audit');
        $this->addSql('ALTER TABLE query DROP FOREIGN KEY FK_24BDB5EBBBDBD894');
        $this->addSql('DROP INDEX IDX_24BDB5EBBBDBD894 ON query');
        $this->addSql('ALTER TABLE query DROP contentBlock_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activity_audit (id INT NOT NULL, rev INT NOT NULL, aidName VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, degreeType VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, trainingName VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, degreeOption VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, degree VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, trainingMode VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, recruitMode VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, benefitType VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, lessonLevel VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, audienceType VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, specificAudience VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, conditions VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, serviceMission VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, publicInfo VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, recMode VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, destinations VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, period VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, cost VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, salary VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, serviceName VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, address VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, address2 VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, zipCode VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, city VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, phone VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, tax VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, email VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, aidNature VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, regLocation VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, comment VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, contact VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, trainingDomain VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, partnership VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, activityDomain VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, revtype VARCHAR(4) NOT NULL COLLATE utf8_unicode_ci, INDEX rev_dea7da8a763652dfdb869459a96841b0_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE article_audit (id INT NOT NULL, rev INT NOT NULL, background_id INT DEFAULT NULL, section_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, introduction TINYTEXT DEFAULT NULL COLLATE utf8_unicode_ci, content TINYTEXT DEFAULT NULL COLLATE utf8_unicode_ci, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, archived DATETIME DEFAULT NULL, published DATETIME DEFAULT NULL, unpublished DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL COLLATE utf8_unicode_ci, INDEX rev_c17ec30d772af1f2052f191e1bcad73b_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE category_audit (id INT NOT NULL, rev INT NOT NULL, logo_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, intro VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, link VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, domain VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, footer VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, published TINYINT(1) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, revtype VARCHAR(4) NOT NULL COLLATE utf8_unicode_ci, INDEX rev_9d60be1ae31861a527fd590d589be976_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE content_audit (id INT NOT NULL, rev INT NOT NULL, section_id INT DEFAULT NULL, background_id INT DEFAULT NULL, logo_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, intro VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, slug VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, published TINYINT(1) DEFAULT NULL, revtype VARCHAR(4) NOT NULL COLLATE utf8_unicode_ci, INDEX rev_1fb08a539f30b5b48cb85d2b1e34d0da_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE content_block_audit (id INT NOT NULL, rev INT NOT NULL, content_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, title VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, text VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, position INT DEFAULT NULL, revtype VARCHAR(4) NOT NULL COLLATE utf8_unicode_ci, query_id INT DEFAULT NULL, INDEX rev_941d0ce4cb1ea44c46ed5c633475f067_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE media_audit (id INT NOT NULL, rev INT NOT NULL, path VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, name VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, mime_type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, size NUMERIC(10, 0) DEFAULT NULL, revtype VARCHAR(4) NOT NULL COLLATE utf8_unicode_ci, INDEX rev_05e5435a629dc17f25bb0ec61460bff6_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE organism_audit (id INT NOT NULL, rev INT NOT NULL, name VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, initials VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, name2 VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, instGroup VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, address VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, address2 VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, postalBox VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, poBox VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, zipCode VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, city VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, OFZipCode VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, OFCity VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, cedex VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, phone VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, phone2 VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, fax VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, email VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, url VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, department INT DEFAULT NULL, academy INT DEFAULT NULL, region INT DEFAULT NULL, country INT DEFAULT NULL, recAddress VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, openHours VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, missions VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, type INT DEFAULT NULL, netName INT DEFAULT NULL, netDescription VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, agreement VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, skills INT DEFAULT NULL, zone VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, note VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, longitude VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, latitude VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, revtype VARCHAR(4) NOT NULL COLLATE utf8_unicode_ci, INDEX rev_c37159073579ac11bf566ecfcb6c8f77_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE query_audit (id INT NOT NULL, rev INT NOT NULL, type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, name VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL COLLATE utf8_unicode_ci, entity VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, contentBlock_id INT DEFAULT NULL, filters LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:json)\', INDEX rev_0784a93a047a3ab607481f70aca7d9b6_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE revisions (id INT AUTO_INCREMENT NOT NULL, timestamp DATETIME NOT NULL, username VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE section_audit (id INT NOT NULL, rev INT NOT NULL, thumb_id INT DEFAULT NULL, category_id INT DEFAULT NULL, background_id INT DEFAULT NULL, logo_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, intro VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, link VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, slug VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, color VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, published TINYINT(1) DEFAULT NULL, revtype VARCHAR(4) NOT NULL COLLATE utf8_unicode_ci, INDEX rev_11e40efc0b13bde195252836548b1b9f_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE query ADD contentBlock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE query ADD CONSTRAINT FK_24BDB5EBBBDBD894 FOREIGN KEY (contentBlock_id) REFERENCES content_block (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_24BDB5EBBBDBD894 ON query (contentBlock_id)');
    }
}
