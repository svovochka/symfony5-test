<?php

declare(strict_types = 1);

namespace App\EntityMapper;

use App\Entity\Book;

/**
 * Class BookMapper
 * @package App\EntityMapper
 */
class BookMapper
{

    /**
     * Maps Book entity to array
     *
     * @param Book $book Book entity
     * @param string|null $locale Required locale
     *
     * @return array
     */
    public static function mapToArray(Book $book, string $locale = null): array
    {
        $result = [
            'id' => $book->getId(),
            'author' => AuthorMapper::mapToArray($book->getAuthor(), $locale)
        ];

        if($locale){
            $result['title'] = $book->translate($locale)->getTitle();
        } else {
            $result['translations'] = [];
            foreach($book->getTranslations() as $translation) {
                $result['translations'][$translation->getLocale()] = [
                    'title' => $translation->getTitle(),
                ];
            }
        }

        return $result;
    }

    /**
     * Maps Book entity list to array
     *
     * @param Book[] $books Books entities
     * @param string|null $locale Required locale
     *
     * @return array
     */
    public static function mapAllToArray(array $books, string $locale = null): array
    {
        $result = [];
        foreach($books as $book){
            $result[] = self::mapToArray($book, $locale);
        }

        return $result;
    }
}