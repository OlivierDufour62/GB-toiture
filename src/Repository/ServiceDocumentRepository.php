<?php

namespace App\Repository;

use App\Entity\ServiceDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiceDocument|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceDocument|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceDocument[]    findAll()
 * @method ServiceDocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceDocument::class);
    }

    // /**
    //  * @return ServiceDocument[] Returns an array of ServiceDocument objects
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

    /*
    public function findOneBySomeField($value): ?ServiceDocument
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
