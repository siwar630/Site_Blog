<?php

namespace App\Repository;

use App\Entity\ContactVisitor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContactVisitor|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactVisitor|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactVisitor[]    findAll()
 * @method ContactVisitor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactVisitorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactVisitor::class);
    }

    // /**
    //  * @return ContactVisitor[] Returns an array of ContactVisitor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContactVisitor
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
