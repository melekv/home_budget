<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230803223842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE period_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id SERIAL NOT NULL PRIMARY KEY, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE category_period (category_id INT NOT NULL, period_id INT NOT NULL, amount MONEY NOT NULL, PRIMARY KEY(category_id, period_id))');
        $this->addSql('CREATE TABLE period (id SERIAL NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE category_period ADD CONSTRAINT FK_CA50D4B512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category_period ADD CONSTRAINT FK_CA50D4B5EC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE period_id_seq CASCADE');
        $this->addSql('ALTER TABLE category_period DROP CONSTRAINT FK_CA50D4B512469DE2');
        $this->addSql('ALTER TABLE category_period DROP CONSTRAINT FK_CA50D4B5EC8B7ADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_period');
        $this->addSql('DROP TABLE period');
    }
}
