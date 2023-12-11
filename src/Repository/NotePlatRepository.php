<?php

namespace App\Repository;

use App\Entity\NotePlat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NotePlat>
 *
 * @method NotePlat|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotePlat|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotePlat[]    findAll()
 * @method NotePlat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotePlatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotePlat::class);
    }

//    /**
//     * @return NotePlat[] Returns an array of NotePlat objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NotePlat
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
