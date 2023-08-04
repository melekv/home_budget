<?php

namespace App\Repository;

use App\Entity\CategoryPeriod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoryPeriod>
 *
 * @method CategoryPeriod|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryPeriod|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryPeriod[]    findAll()
 * @method CategoryPeriod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryPeriodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryPeriod::class);
    }

//    /**
//     * @return CategoryPeriod[] Returns an array of CategoryPeriod objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CategoryPeriod
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
