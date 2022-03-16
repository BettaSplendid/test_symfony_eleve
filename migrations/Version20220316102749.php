<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220316102749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE citizen_study DROP FOREIGN KEY FK_9135A21AE7B003E9');
        $this->addSql('CREATE TABLE citizen (id INT AUTO_INCREMENT NOT NULL, mentored_id INT DEFAULT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', role_type VARCHAR(255) NOT NULL, badge_number INT DEFAULT NULL, INDEX IDX_A95317293C307436 (mentored_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE citizen_lesson (citizen_id INT NOT NULL, lesson_id INT NOT NULL, INDEX IDX_A613E88A63C3C2E (citizen_id), INDEX IDX_A613E88CDF80196 (lesson_id), PRIMARY KEY(citizen_id, lesson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, test_id INT DEFAULT NULL, tested_citizen_id INT DEFAULT NULL, grade DOUBLE PRECISION NOT NULL, INDEX IDX_595AAE341E5D0459 (test_id), INDEX IDX_595AAE34EFD1879B (tested_citizen_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, start DATETIME NOT NULL, finish DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, matter_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_D87F7E0CD614E59F (matter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE citizen ADD CONSTRAINT FK_A95317293C307436 FOREIGN KEY (mentored_id) REFERENCES citizen (id)');
        $this->addSql('ALTER TABLE citizen_lesson ADD CONSTRAINT FK_A613E88A63C3C2E FOREIGN KEY (citizen_id) REFERENCES citizen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE citizen_lesson ADD CONSTRAINT FK_A613E88CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grade ADD CONSTRAINT FK_595AAE341E5D0459 FOREIGN KEY (test_id) REFERENCES test (id)');
        $this->addSql('ALTER TABLE grade ADD CONSTRAINT FK_595AAE34EFD1879B FOREIGN KEY (tested_citizen_id) REFERENCES citizen (id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CD614E59F FOREIGN KEY (matter_id) REFERENCES lesson (id)');
        $this->addSql('DROP TABLE citizen_study');
        $this->addSql('DROP TABLE study');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE citizen DROP FOREIGN KEY FK_A95317293C307436');
        $this->addSql('ALTER TABLE citizen_lesson DROP FOREIGN KEY FK_A613E88A63C3C2E');
        $this->addSql('ALTER TABLE grade DROP FOREIGN KEY FK_595AAE34EFD1879B');
        $this->addSql('ALTER TABLE citizen_lesson DROP FOREIGN KEY FK_A613E88CDF80196');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CD614E59F');
        $this->addSql('ALTER TABLE grade DROP FOREIGN KEY FK_595AAE341E5D0459');
        $this->addSql('CREATE TABLE citizen_study (citizen_id INT NOT NULL, study_id INT NOT NULL, INDEX IDX_9135A21AA63C3C2E (citizen_id), INDEX IDX_9135A21AE7B003E9 (study_id), PRIMARY KEY(citizen_id, study_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE study (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, start DATETIME NOT NULL, finish DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE citizen_study ADD CONSTRAINT FK_9135A21AE7B003E9 FOREIGN KEY (study_id) REFERENCES study (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE citizen');
        $this->addSql('DROP TABLE citizen_lesson');
        $this->addSql('DROP TABLE grade');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE test');
    }
}
