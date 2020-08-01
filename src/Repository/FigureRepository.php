<?php

namespace Suminagashi\FiguresBundle\Repository;

use Suminagashi\FiguresBundle\Figure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Figure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Figure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Figure[]    findAll()
 * @method Figure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FigureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Figure::class);
    }

    // /**
    //  * @return Figure[] Returns an array of Figure objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findByKey($key): ?Figure
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.key = :key')
            ->setParameter('key', $key)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findAllAsArray()
    {
        return $this->createQueryBuilder('s')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function getCumulRange($range)
    {
        return $range;
    }

    public function getCumulDiff($start, $end)
    {
        return $start;
    }

    public function getCountRange($range)
    {
        return $range;
    }

    public function getCountDiff($start, $end)
    {
        return $start;
    }
}
