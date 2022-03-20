<?php

namespace App\Repository;

use App\Entity\VarietyTypeDoctrine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VarietyTypeDoctrine|null find($id, $lockMode = null, $lockVersion = null)
 * @method VarietyTypeDoctrine|null findOneBy(array $criteria, array $orderBy = null)
 * @method VarietyTypeDoctrine[]    findAll()
 * @method VarietyTypeDoctrine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineVarietyTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VarietyTypeDoctrine::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VarietyTypeDoctrine $entity, bool $flush = true): void
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
    public function remove(VarietyTypeDoctrine $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return VarietyTypeDoctrine[] Returns an array of VarietyTypeDoctrine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VarietyTypeDoctrine
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
