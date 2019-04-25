<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190424082526 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_audit (id INT NOT NULL, rev INT NOT NULL, logo_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, intro VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, domain VARCHAR(255) DEFAULT NULL, footer VARCHAR(255) DEFAULT NULL, published TINYINT(1) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_9d60be1ae31861a527fd590d589be976_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organism_audit (id INT NOT NULL, rev INT NOT NULL, name VARCHAR(255) DEFAULT NULL, initials VARCHAR(255) DEFAULT NULL, name2 VARCHAR(255) DEFAULT NULL, instGroup VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, address2 VARCHAR(255) DEFAULT NULL, postalBox VARCHAR(255) DEFAULT NULL, poBox VARCHAR(255) DEFAULT NULL, zipCode VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, OFZipCode VARCHAR(255) DEFAULT NULL, OFCity VARCHAR(255) DEFAULT NULL, cedex VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, phone2 VARCHAR(255) DEFAULT NULL, fax VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, department INT DEFAULT NULL, academy INT DEFAULT NULL, region INT DEFAULT NULL, country INT DEFAULT NULL, recAddress VARCHAR(255) DEFAULT NULL, openHours VARCHAR(255) DEFAULT NULL, missions VARCHAR(255) DEFAULT NULL, type INT DEFAULT NULL, netName INT DEFAULT NULL, netDescription VARCHAR(255) DEFAULT NULL, agreement VARCHAR(255) DEFAULT NULL, skills INT DEFAULT NULL, zone VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_c37159073579ac11bf566ecfcb6c8f77_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section_audit (id INT NOT NULL, rev INT NOT NULL, thumb_id INT DEFAULT NULL, category_id INT DEFAULT NULL, background_id INT DEFAULT NULL, logo_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, intro VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, published TINYINT(1) DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_11e40efc0b13bde195252836548b1b9f_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE query_filter_audit (id INT NOT NULL, rev INT NOT NULL, entity VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, field VARCHAR(255) DEFAULT NULL, value VARCHAR(255) DEFAULT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_049340839b1adb9735bea42783cc5863_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_block_audit (id INT NOT NULL, rev INT NOT NULL, content_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, text VARCHAR(255) DEFAULT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, position INT DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_941d0ce4cb1ea44c46ed5c633475f067_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE query_audit (id INT NOT NULL, rev INT NOT NULL, type VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_0784a93a047a3ab607481f70aca7d9b6_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_audit (id INT NOT NULL, rev INT NOT NULL, background_id INT DEFAULT NULL, section_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, introduction TINYTEXT DEFAULT NULL, content TINYTEXT DEFAULT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, archived DATETIME DEFAULT NULL, published DATETIME DEFAULT NULL, unpublished DATETIME DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_c17ec30d772af1f2052f191e1bcad73b_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_audit (id INT NOT NULL, rev INT NOT NULL, section_id INT DEFAULT NULL, background_id INT DEFAULT NULL, logo_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, intro VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, published TINYINT(1) DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_1fb08a539f30b5b48cb85d2b1e34d0da_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_audit (id INT NOT NULL, rev INT NOT NULL, path VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, mime_type VARCHAR(255) DEFAULT NULL, size NUMERIC(10, 0) DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_05e5435a629dc17f25bb0ec61460bff6_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_audit (id INT NOT NULL, rev INT NOT NULL, aidName VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, degreeType VARCHAR(255) DEFAULT NULL, trainingName VARCHAR(255) DEFAULT NULL, degreeOption VARCHAR(255) DEFAULT NULL, degree VARCHAR(255) DEFAULT NULL, trainingMode VARCHAR(255) DEFAULT NULL, recruitMode VARCHAR(255) DEFAULT NULL, benefitType VARCHAR(255) DEFAULT NULL, lessonLevel VARCHAR(255) DEFAULT NULL, audienceType VARCHAR(255) DEFAULT NULL, specificAudience VARCHAR(255) DEFAULT NULL, conditions VARCHAR(255) DEFAULT NULL, serviceMission VARCHAR(255) DEFAULT NULL, publicInfo VARCHAR(255) DEFAULT NULL, recMode VARCHAR(255) DEFAULT NULL, destinations VARCHAR(255) DEFAULT NULL, period VARCHAR(255) DEFAULT NULL, cost VARCHAR(255) DEFAULT NULL, salary VARCHAR(255) DEFAULT NULL, serviceName VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, address2 VARCHAR(255) DEFAULT NULL, zipCode VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, tax VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, aidNature VARCHAR(255) DEFAULT NULL, regLocation VARCHAR(255) DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, contact VARCHAR(255) DEFAULT NULL, trainingDomain VARCHAR(255) DEFAULT NULL, partnership VARCHAR(255) DEFAULT NULL, activityDomain VARCHAR(255) DEFAULT NULL, revtype VARCHAR(4) NOT NULL, INDEX rev_dea7da8a763652dfdb869459a96841b0_idx (rev), PRIMARY KEY(id, rev)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revisions (id INT AUTO_INCREMENT NOT NULL, timestamp DATETIME NOT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category DROP deletedAt');
        $this->addSql('ALTER TABLE organism DROP deletedAt');
        $this->addSql('ALTER TABLE section DROP deletedAt');
        $this->addSql('ALTER TABLE query_filter DROP deletedAt');
        $this->addSql('ALTER TABLE content_block ADD position INT NOT NULL, DROP deletedAt, DROP published');
        $this->addSql('ALTER TABLE query DROP deletedAt');
        $this->addSql('ALTER TABLE article DROP deletedAt');
        $this->addSql('ALTER TABLE content DROP deletedAt');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE category_audit');
        $this->addSql('DROP TABLE organism_audit');
        $this->addSql('DROP TABLE section_audit');
        $this->addSql('DROP TABLE query_filter_audit');
        $this->addSql('DROP TABLE content_block_audit');
        $this->addSql('DROP TABLE query_audit');
        $this->addSql('DROP TABLE article_audit');
        $this->addSql('DROP TABLE content_audit');
        $this->addSql('DROP TABLE media_audit');
        $this->addSql('DROP TABLE activity_audit');
        $this->addSql('DROP TABLE revisions');
        $this->addSql('ALTER TABLE article ADD deletedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD deletedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE content ADD deletedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE content_block ADD deletedAt DATETIME DEFAULT NULL, ADD published TINYINT(1) NOT NULL, DROP position');
        $this->addSql('ALTER TABLE organism ADD deletedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE query ADD deletedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE query_filter ADD deletedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE section ADD deletedAt DATETIME DEFAULT NULL');
    }
}
