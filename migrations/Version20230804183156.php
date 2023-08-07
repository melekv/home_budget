<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230804183156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE period_id_seq1 CASCADE');
        $this->addSql('CREATE TABLE expense (id SERIAL NOT NULL, category_id INT NOT NULL, amount MONEY NOT NULL, date DATE NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE period ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE expense_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE period_id_seq1 INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE expense DROP CONSTRAINT FK_2D3A8DA612469DE2');
        $this->addSql('DROP TABLE expense');
        $this->addSql('CREATE SEQUENCE period_id_seq');
        $this->addSql('SELECT setval(\'period_id_seq\', (SELECT MAX(id) FROM period))');
        $this->addSql('ALTER TABLE period ALTER id SET DEFAULT nextval(\'period_id_seq\')');
        $this->addSql('ALTER TABLE category_period ALTER amount TYPE NUMERIC(10, 0)');
        $this->addSql('CREATE SEQUENCE category_id_seq');
        $this->addSql('SELECT setval(\'category_id_seq\', (SELECT MAX(id) FROM category))');
        $this->addSql('ALTER TABLE category ALTER id SET DEFAULT nextval(\'category_id_seq\')');
    }
}
