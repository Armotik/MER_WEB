<?php

namespace App\Repository;

use App\Entity\ArtCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArtCategory>
 *
 * @method ArtCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtCategory[]    findAll()
 * @method ArtCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtCategory::class);
    }

//    /**
//     * @return ArtCategory[] Returns an array of ArtCategory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ArtCategory
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
