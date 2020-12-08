<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\AuthorTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class AuthorTranslationRepository
 * @package App\Repository
 *
 * @method AuthorTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuthorTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuthorTranslation[]    findAll()
 * @method AuthorTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorTranslationRepository extends ServiceEntityRepository
{
    /**
     * AuthorTranslationRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuthorTranslation::class);
    }
}
