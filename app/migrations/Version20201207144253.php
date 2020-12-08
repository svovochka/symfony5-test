<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201207144253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'DDL Create initial schema';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id SERIAL NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE author_translation (id SERIAL NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E89826172C2AC5D3 ON author_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX author_translation_unique_translation ON author_translation (translatable_id, locale)');
        $this->addSql('CREATE TABLE book (id SERIAL NOT NULL, author_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CBE5A331F675F31B ON book (author_id)');
        $this->addSql('CREATE TABLE book_translation (id SERIAL NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E69E0A132C2AC5D3 ON book_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX book_translation_unique_translation ON book_translation (translatable_id, locale)');
        $this->addSql('ALTER TABLE author_translation ADD CONSTRAINT FK_E89826172C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_translation ADD CONSTRAINT FK_E69E0A132C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE author_translation DROP CONSTRAINT FK_E89826172C2AC5D3');
        $this->addSql('ALTER TABLE book DROP CONSTRAINT FK_CBE5A331F675F31B');
        $this->addSql('ALTER TABLE book_translation DROP CONSTRAINT FK_E69E0A132C2AC5D3');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE author_translation');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_translation');
    }
}
