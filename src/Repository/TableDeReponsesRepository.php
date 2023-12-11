<?php

namespace App\Repository;

use App\Entity\TableDeReponses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TableDeReponses>
 *
 * @method TableDeReponses|null find($id, $lockMode = null, $lockVersion = null)
 * @method TableDeReponses|null findOneBy(array $criteria, array $orderBy = null)
 * @method TableDeReponses[]    findAll()
 * @method TableDeReponses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableDeReponsesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TableDeReponses::class);
    }

//    /**
//     * @return TableDeReponses[] Returns an array of TableDeReponses objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TableDeReponses
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
