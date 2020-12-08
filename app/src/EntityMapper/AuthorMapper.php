<?php

declare(strict_types = 1);

namespace App\EntityMapper;

use App\Entity\Author;

/**
 * Class AuthorMapper
 * @package App\EntityMapper
 */
class AuthorMapper
{

    /**
     * Maps Author entity to array
     *
     * @param Author $author Author entity
     * @param string|null $locale Required locale
     *
     * @return array
     */
    public static function mapToArray(Author $author, string $locale = null): array
    {
        $result = [
            'id' => $author->getId(),
        ];

        if($locale){
           $result['name'] = $author->translate($locale)->getName();
        } else {
            $result['translations'] = [];
            foreach($author->getTranslations() as $translation) {
                $result['translations'][$translation->getLocale()] = [
                  'name' => $translation->getName(),
                ];
            }
        }

        return $result;
    }
}