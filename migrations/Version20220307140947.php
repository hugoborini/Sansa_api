<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307140947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE final_user (id INT AUTO_INCREMENT NOT NULL, secret_question_id INT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, favorites LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', secret_answer VARCHAR(255) NOT NULL, INDEX IDX_4EB1400834911AD5 (secret_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hours (id INT AUTO_INCREMENT NOT NULL, service_id_id INT NOT NULL, monday VARCHAR(255) DEFAULT NULL, tuesday VARCHAR(255) DEFAULT NULL, wednesday VARCHAR(255) DEFAULT NULL, thurday VARCHAR(255) DEFAULT NULL, friday VARCHAR(255) DEFAULT NULL, saturday VARCHAR(255) DEFAULT NULL, sunday VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8A1ABD8DD63673B0 (service_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organization (id INT AUTO_INCREMENT NOT NULL, organization_owner_id INT DEFAULT NULL, organization_name VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, last_updata DATE NOT NULL, phone_number VARCHAR(255) NOT NULL, website VARCHAR(255) DEFAULT NULL, spoken_language VARCHAR(255) NOT NULL, importante_information VARCHAR(255) NOT NULL, INDEX IDX_C1EE637C9124A35B (organization_owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organization_owner (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preferencial_welcome (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secret_question (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, organization_id_id INT DEFAULT NULL, category_id_id INT DEFAULT NULL, service_name VARCHAR(255) NOT NULL, subscribe TINYINT(1) DEFAULT NULL, by_appointement TINYINT(1) DEFAULT NULL, service_description LONGTEXT DEFAULT NULL, state_saturation INT DEFAULT NULL, INDEX IDX_7332E169F1C37890 (organization_id_id), INDEX IDX_7332E1699777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE final_user ADD CONSTRAINT FK_4EB1400834911AD5 FOREIGN KEY (secret_question_id) REFERENCES secret_question (id)');
        $this->addSql('ALTER TABLE hours ADD CONSTRAINT FK_8A1ABD8DD63673B0 FOREIGN KEY (service_id_id) REFERENCES services (id)');
        $this->addSql('ALTER TABLE organization ADD CONSTRAINT FK_C1EE637C9124A35B FOREIGN KEY (organization_owner_id) REFERENCES organization_owner (id)');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E169F1C37890 FOREIGN KEY (organization_id_id) REFERENCES organization (id)');
        $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E1699777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E1699777D11E');
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E169F1C37890');
        $this->addSql('ALTER TABLE organization DROP FOREIGN KEY FK_C1EE637C9124A35B');
        $this->addSql('ALTER TABLE final_user DROP FOREIGN KEY FK_4EB1400834911AD5');
        $this->addSql('ALTER TABLE hours DROP FOREIGN KEY FK_8A1ABD8DD63673B0');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE final_user');
        $this->addSql('DROP TABLE hours');
        $this->addSql('DROP TABLE organization');
        $this->addSql('DROP TABLE organization_owner');
        $this->addSql('DROP TABLE preferencial_welcome');
        $this->addSql('DROP TABLE secret_question');
        $this->addSql('DROP TABLE services');
    }
}
