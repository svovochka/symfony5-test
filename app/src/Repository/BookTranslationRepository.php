<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\BookTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class BookTranslationRepository
 * @package App\Repository
 *
 * @method BookTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookTranslation[]    findAll()
 * @method BookTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookTranslationRepository extends ServiceEntityRepository
{
    /**
     * BookTranslationRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookTranslation::class);
    }
}
