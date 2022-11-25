<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221125155340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidate (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_C8B28E44E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, UNIQUE INDEX UNIQ_4FBF094F5E237E06 (name), UNIQUE INDEX UNIQ_4FBF094F444F97DD (phone), UNIQUE INDEX UNIQ_4FBF094FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, candidate_id INT DEFAULT NULL, position VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, file VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, INDEX IDX_B66FFE9291BD8781 (candidate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reaction (id INT AUTO_INCREMENT NOT NULL, cv_id INT DEFAULT NULL, company_id INT DEFAULT NULL, type INT NOT NULL, created_at DATETIME NOT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, INDEX IDX_A4D707F7CFE419E2 (cv_id), INDEX IDX_A4D707F7979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE9291BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F7CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F7979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE user ADD company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649979B1AD6 ON user (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649979B1AD6');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FA76ED395');
        $this->addSql('ALTER TABLE cv DROP FOREIGN KEY FK_B66FFE9291BD8781');
        $this->addSql('ALTER TABLE reaction DROP FOREIGN KEY FK_A4D707F7CFE419E2');
        $this->addSql('ALTER TABLE reaction DROP FOREIGN KEY FK_A4D707F7979B1AD6');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE reaction');
        $this->addSql('DROP INDEX UNIQ_8D93D649979B1AD6 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP company_id');
    }
}
