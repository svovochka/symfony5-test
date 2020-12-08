<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class BookRepository
 * @package App\Repository
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    /**
     * BookRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * Search books by title
     *
     * @param string $search
     * @param string|null $locale
     *
     * @return array
     */
    public function searchByTitle(string $search, ?string $locale = null): array
    {
        $qb = $this
            ->createQueryBuilder('b')
            ->innerJoin('b.translations', 't')
            ->andWhere('LOWER(t.title) LIKE LOWER(:title)')
            ->setParameter('title', '%' . $search . '%')
            ->orderBy('t.title', 'ASC');

        if (!is_null($locale)) {
            $qb
                ->andWhere('t.locale = :locale')
                ->setParameter('locale', $locale);
        }

        return $qb
            ->getQuery()
            ->getResult();
    }
}
