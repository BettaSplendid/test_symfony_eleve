<?php

namespace App\Repository;

use App\Entity\BrochureTesto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BrochureTesto|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrochureTesto|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrochureTesto[]    findAll()
 * @method BrochureTesto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrochureTestoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrochureTesto::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(BrochureTesto $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(BrochureTesto $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return BrochureTesto[] Returns an array of BrochureTesto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BrochureTesto
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
