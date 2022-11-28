<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221128224538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE companies_cvs (company_id INT NOT NULL, cv_id INT NOT NULL, INDEX IDX_9408E319979B1AD6 (company_id), INDEX IDX_9408E319CFE419E2 (cv_id), PRIMARY KEY(company_id, cv_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE companies_cvs ADD CONSTRAINT FK_9408E319979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE companies_cvs ADD CONSTRAINT FK_9408E319CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE companies_cvs DROP FOREIGN KEY FK_9408E319979B1AD6');
        $this->addSql('ALTER TABLE companies_cvs DROP FOREIGN KEY FK_9408E319CFE419E2');
        $this->addSql('DROP TABLE companies_cvs');
    }
}
