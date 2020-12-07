<?php

namespace App\Repository;

use App\Entity\AuthorTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AuthorTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuthorTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuthorTranslation[]    findAll()
 * @method AuthorTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuthorTranslation::class);
    }

    // /**
    //  * @return AuthorTranslation[] Returns an array of AuthorTranslation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AuthorTranslation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
