<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208061013 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'DML Populate database with demo data (10 000 authors and books)';
    }

    /**
     * Generate 10 000 authors and books
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        //TODO run this only in dev mode
        $authorValues = [];
        $authorTranslationValues = [];
        $bookValues = [];
        $bookTranslationValues = [];

        for ($i = 1; $i <= 10000; $i++) {
            // TODO generate random unique names and titles similar to real or use real dictionary
            $authorValues[] = '('.$i.')';
            $authorTranslationValues[] = '(DEFAULT, '.$i.',\'Author'.$i.'\', \'en\')';
            $authorTranslationValues[] = '(DEFAULT, '.$i.',\'Автор'.$i.'\', \'ru\')';
            $bookValues[] = '('.$i.','.$i.')';
            $bookTranslationValues[] = '(DEFAULT, '.$i.',\'Book'.$i.'\', \'en\')';
            $bookTranslationValues[] = '(DEFAULT, '.$i.',\'Книга'.$i.'\', \'ru\')';
        }

        $this->addSql('INSERT INTO author (id) VALUES ' . implode(',', $authorValues));
        $this->addSql('INSERT INTO author_translation (id, translatable_id, name, locale) VALUES ' . implode(',', $authorTranslationValues));
        $this->addSql('INSERT INTO book (id, author_id) VALUES ' . implode(',', $bookValues));
        $this->addSql('INSERT INTO book_translation (id, translatable_id, title, locale) VALUES ' . implode(',', $bookTranslationValues));

        $this->addSql('SELECT setval(\'author_id_seq\', (SELECT MAX(id) FROM author)+1);');
        $this->addSql('SELECT setval(\'author_translation_id_seq\', (SELECT MAX(id) FROM author_translation)+1);');
        $this->addSql('SELECT setval(\'book_id_seq\', (SELECT MAX(id) FROM book)+1);');
        $this->addSql('SELECT setval(\'book_translation_id_seq\', (SELECT MAX(id) FROM book_translation)+1);');
    }

    /**
     * Empty all tables
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        //TODO run this only in dev mode
        $this->addSql('DELETE FROM author_translation');
        $this->addSql('DELETE FROM book_translation');
        $this->addSql('DELETE FROM book');
        $this->addSql('DELETE FROM author');

        $this->addSql('SELECT setval(\'author_id_seq\', (SELECT MAX(id) FROM author)+1);');
        $this->addSql('SELECT setval(\'author_translation_id_seq\', (SELECT MAX(id) FROM author_translation)+1);');
        $this->addSql('SELECT setval(\'book_id_seq\', (SELECT MAX(id) FROM book)+1);');
        $this->addSql('SELECT setval(\'book_translation_id_seq\', (SELECT MAX(id) FROM book_translation)+1);');
    }
}
