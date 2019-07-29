<?php

namespace App\Repository;

use App\Entity\MyDataBase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MyDataBase|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyDataBase|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyDataBase[]    findAll()
 * @method MyDataBase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyDataBaseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MyDataBase::class);
    }

    // /**
    //  * @return MyDataBase[] Returns an array of MyDataBase objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MyDataBase
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
