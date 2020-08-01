<?php

namespace Suminagashi\FiguresBundle\Repository;

use Suminagashi\FiguresBundle\Entity\Figure;
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

    public function findAllAsArray()
    {
        return $this->createQueryBuilder('s')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function getAll($key)
    {
        return $this->createQueryBuilder('f')
        ->where('f.key = :key')
        ->setParameter('key', $key)
        ->select('SUM(f.value) as result')
        ->getQuery()
        ->getOneOrNullResult();

    }

    public function getByRange($key, $start, $end)
    {
        return $this->createQueryBuilder('f')
        ->where('f.key = :key')
        ->setParameter('key', $key)
        ->andWhere('f.createdAt BETWEEN :start AND :end')
        ->setParameter('start', $start)
        ->setParameter('end', $end)
        ->select('SUM(f.value) as result')
        ->getQuery()
        ->getOneOrNullResult();
    }


}
