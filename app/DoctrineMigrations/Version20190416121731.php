<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190416121731 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, logo_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, intro VARCHAR(255) NOT NULL, link VARCHAR(255) DEFAULT NULL, domain VARCHAR(255) DEFAULT NULL, footer VARCHAR(255) NOT NULL, deletedAt DATETIME DEFAULT NULL, published TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_64C19C1F98F144A (logo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_route (category_id INT NOT NULL, route_id INT NOT NULL, INDEX IDX_EAF76F3012469DE2 (category_id), INDEX IDX_EAF76F3034ECB4E6 (route_id), PRIMARY KEY(category_id, route_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, size NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, background_id INT DEFAULT NULL, section_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, introduction TINYTEXT DEFAULT NULL, content TINYTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, archived DATETIME DEFAULT NULL, published DATETIME DEFAULT NULL, unpublished DATETIME DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, INDEX IDX_1DD39950C93D69EA (background_id), INDEX IDX_1DD39950D823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, thumb_id INT DEFAULT NULL, category_id INT DEFAULT NULL, background_id INT DEFAULT NULL, logo_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, intro VARCHAR(255) NOT NULL, link VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, published TINYINT(1) NOT NULL, INDEX IDX_2D737AEFC7034EA5 (thumb_id), INDEX IDX_2D737AEF12469DE2 (category_id), INDEX IDX_2D737AEFC93D69EA (background_id), INDEX IDX_2D737AEFF98F144A (logo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section_route (section_id INT NOT NULL, route_id INT NOT NULL, INDEX IDX_9593471DD823E37A (section_id), INDEX IDX_9593471D34ECB4E6 (route_id), PRIMARY KEY(section_id, route_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, section_id INT DEFAULT NULL, background_id INT DEFAULT NULL, logo_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, intro VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, published TINYINT(1) NOT NULL, INDEX IDX_FEC530A9D823E37A (section_id), INDEX IDX_FEC530A9C93D69EA (background_id), INDEX IDX_FEC530A9F98F144A (logo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_route (content_id INT NOT NULL, route_id INT NOT NULL, INDEX IDX_E90774AB84A0A3ED (content_id), INDEX IDX_E90774AB34ECB4E6 (route_id), PRIMARY KEY(content_id, route_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organism (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, initials VARCHAR(255) DEFAULT NULL, name2 VARCHAR(255) DEFAULT NULL, instGroup VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, address2 VARCHAR(255) DEFAULT NULL, postalBox VARCHAR(255) DEFAULT NULL, poBox VARCHAR(255) DEFAULT NULL, zipCode VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, OFZipCode VARCHAR(255) DEFAULT NULL, OFCity VARCHAR(255) DEFAULT NULL, cedex VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, phone2 VARCHAR(255) DEFAULT NULL, fax VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, department INT DEFAULT NULL, academy INT DEFAULT NULL, region INT DEFAULT NULL, country INT DEFAULT NULL, recAddress VARCHAR(255) DEFAULT NULL, openHours VARCHAR(255) DEFAULT NULL, missions VARCHAR(255) DEFAULT NULL, type INT DEFAULT NULL, netName INT DEFAULT NULL, netDescription VARCHAR(255) DEFAULT NULL, agreement VARCHAR(255) DEFAULT NULL, skills INT DEFAULT NULL, zone VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE query (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE query_query_filter (query_id INT NOT NULL, query_filter_id INT NOT NULL, INDEX IDX_27BFA0E0EF946F99 (query_id), INDEX IDX_27BFA0E025F9BEEE (query_filter_id), PRIMARY KEY(query_id, query_filter_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE query_filter (id INT AUTO_INCREMENT NOT NULL, entity VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, field VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_block (id INT AUTO_INCREMENT NOT NULL, content_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, text VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, deletedAt DATETIME DEFAULT NULL, published TINYINT(1) NOT NULL, INDEX IDX_68D8C3F084A0A3ED (content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_block_query (content_block_id INT NOT NULL, query_id INT NOT NULL, INDEX IDX_B086D98BBB5A68E3 (content_block_id), INDEX IDX_B086D98BEF946F99 (query_id), PRIMARY KEY(content_block_id, query_id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, aidName VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, degreeType VARCHAR(255) DEFAULT NULL, trainingName VARCHAR(255) DEFAULT NULL, degreeOption VARCHAR(255) DEFAULT NULL, degree VARCHAR(255) DEFAULT NULL, trainingMode VARCHAR(255) DEFAULT NULL, recruitMode VARCHAR(255) DEFAULT NULL, benefitType VARCHAR(255) DEFAULT NULL, lessonLevel VARCHAR(255) DEFAULT NULL, audienceType VARCHAR(255) DEFAULT NULL, specificAudience VARCHAR(255) DEFAULT NULL, conditions VARCHAR(255) DEFAULT NULL, serviceMission VARCHAR(255) DEFAULT NULL, publicInfo VARCHAR(255) DEFAULT NULL, recMode VARCHAR(255) DEFAULT NULL, destinations VARCHAR(255) DEFAULT NULL, period VARCHAR(255) DEFAULT NULL, cost VARCHAR(255) DEFAULT NULL, salary VARCHAR(255) DEFAULT NULL, serviceName VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, address2 VARCHAR(255) DEFAULT NULL, zipCode VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, tax VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, aidNature VARCHAR(255) DEFAULT NULL, regLocation VARCHAR(255) DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, contact VARCHAR(255) DEFAULT NULL, trainingDomain VARCHAR(255) DEFAULT NULL, partnership VARCHAR(255) DEFAULT NULL, activityDomain VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orm_routes (id INT AUTO_INCREMENT NOT NULL, host VARCHAR(255) NOT NULL, schemes LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', methods LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', defaults LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', requirements LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', options LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', condition_expr VARCHAR(255) DEFAULT NULL, variable_pattern VARCHAR(255) DEFAULT NULL, staticPrefix VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, position INT NOT NULL, UNIQUE INDEX UNIQ_5793FC5E237E06 (name), INDEX name_idx (name), INDEX prefix_idx (staticPrefix), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1F98F144A FOREIGN KEY (logo_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE category_route ADD CONSTRAINT FK_EAF76F3012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_route ADD CONSTRAINT FK_EAF76F3034ECB4E6 FOREIGN KEY (route_id) REFERENCES orm_routes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950C93D69EA FOREIGN KEY (background_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFC7034EA5 FOREIGN KEY (thumb_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFC93D69EA FOREIGN KEY (background_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFF98F144A FOREIGN KEY (logo_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE section_route ADD CONSTRAINT FK_9593471DD823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE section_route ADD CONSTRAINT FK_9593471D34ECB4E6 FOREIGN KEY (route_id) REFERENCES orm_routes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9C93D69EA FOREIGN KEY (background_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9F98F144A FOREIGN KEY (logo_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE content_route ADD CONSTRAINT FK_E90774AB84A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_route ADD CONSTRAINT FK_E90774AB34ECB4E6 FOREIGN KEY (route_id) REFERENCES orm_routes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE query_query_filter ADD CONSTRAINT FK_27BFA0E0EF946F99 FOREIGN KEY (query_id) REFERENCES query (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE query_query_filter ADD CONSTRAINT FK_27BFA0E025F9BEEE FOREIGN KEY (query_filter_id) REFERENCES query_filter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_block ADD CONSTRAINT FK_68D8C3F084A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE content_block_query ADD CONSTRAINT FK_B086D98BBB5A68E3 FOREIGN KEY (content_block_id) REFERENCES content_block (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_block_query ADD CONSTRAINT FK_B086D98BEF946F99 FOREIGN KEY (query_id) REFERENCES query (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category_route DROP FOREIGN KEY FK_EAF76F3012469DE2');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF12469DE2');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1F98F144A');
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950C93D69EA');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFC7034EA5');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFC93D69EA');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFF98F144A');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9C93D69EA');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9F98F144A');
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950D823E37A');
        $this->addSql('ALTER TABLE section_route DROP FOREIGN KEY FK_9593471DD823E37A');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9D823E37A');
        $this->addSql('ALTER TABLE content_route DROP FOREIGN KEY FK_E90774AB84A0A3ED');
        $this->addSql('ALTER TABLE content_block DROP FOREIGN KEY FK_68D8C3F084A0A3ED');
        $this->addSql('ALTER TABLE query_query_filter DROP FOREIGN KEY FK_27BFA0E0EF946F99');
        $this->addSql('ALTER TABLE content_block_query DROP FOREIGN KEY FK_B086D98BEF946F99');
        $this->addSql('ALTER TABLE query_query_filter DROP FOREIGN KEY FK_27BFA0E025F9BEEE');
        $this->addSql('ALTER TABLE content_block_query DROP FOREIGN KEY FK_B086D98BBB5A68E3');
        $this->addSql('ALTER TABLE category_route DROP FOREIGN KEY FK_EAF76F3034ECB4E6');
        $this->addSql('ALTER TABLE section_route DROP FOREIGN KEY FK_9593471D34ECB4E6');
        $this->addSql('ALTER TABLE content_route DROP FOREIGN KEY FK_E90774AB34ECB4E6');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_route');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE section_route');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE content_route');
        $this->addSql('DROP TABLE organism');
        $this->addSql('DROP TABLE query');
        $this->addSql('DROP TABLE query_query_filter');
        $this->addSql('DROP TABLE query_filter');
        $this->addSql('DROP TABLE content_block');
        $this->addSql('DROP TABLE content_block_query');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE orm_routes');
    }
}
