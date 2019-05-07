<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190503100521 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL, ADD consentName TINYINT(1) NOT NULL, ADD lastName VARCHAR(255) NOT NULL, ADD consentLastName TINYINT(1) NOT NULL, ADD username VARCHAR(255) NOT NULL, ADD birthdate DATETIME NOT NULL, ADD gender VARCHAR(255) NOT NULL, ADD age INT NOT NULL, ADD status VARCHAR(255) NOT NULL, ADD consentMail TINYINT(1) NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD zipcode VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD department VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) NOT NULL, ADD usePhone TINYINT(1) NOT NULL, ADD mobile VARCHAR(255) NOT NULL, ADD useMobile TINYINT(1) NOT NULL, ADD consentTerms TINYINT(1) NOT NULL, ADD consentNews TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user_audit ADD name VARCHAR(255) DEFAULT NULL, ADD consentName TINYINT(1) DEFAULT NULL, ADD lastName VARCHAR(255) DEFAULT NULL, ADD consentLastName TINYINT(1) DEFAULT NULL, ADD username VARCHAR(255) DEFAULT NULL, ADD birthdate DATETIME DEFAULT NULL, ADD gender VARCHAR(255) DEFAULT NULL, ADD age INT DEFAULT NULL, ADD status VARCHAR(255) DEFAULT NULL, ADD consentMail TINYINT(1) DEFAULT NULL, ADD address VARCHAR(255) DEFAULT NULL, ADD zipcode VARCHAR(255) DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL, ADD department VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(255) DEFAULT NULL, ADD usePhone TINYINT(1) DEFAULT NULL, ADD mobile VARCHAR(255) DEFAULT NULL, ADD useMobile TINYINT(1) DEFAULT NULL, ADD consentTerms TINYINT(1) DEFAULT NULL, ADD consentNews TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP name, DROP consentName, DROP lastName, DROP consentLastName, DROP username, DROP birthdate, DROP gender, DROP age, DROP status, DROP consentMail, DROP address, DROP zipcode, DROP city, DROP department, DROP phone, DROP usePhone, DROP mobile, DROP useMobile, DROP consentTerms, DROP consentNews');
        $this->addSql('ALTER TABLE user_audit DROP name, DROP consentName, DROP lastName, DROP consentLastName, DROP username, DROP birthdate, DROP gender, DROP age, DROP status, DROP consentMail, DROP address, DROP zipcode, DROP city, DROP department, DROP phone, DROP usePhone, DROP mobile, DROP useMobile, DROP consentTerms, DROP consentNews');
    }
}
