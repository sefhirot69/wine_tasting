<?php

namespace App\Repository;

use App\Entity\MeasurementTypeDoctrine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MeasurementTypeDoctrine|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeasurementTypeDoctrine|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeasurementTypeDoctrine[]    findAll()
 * @method MeasurementTypeDoctrine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineMeasurementTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeasurementTypeDoctrine::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MeasurementTypeDoctrine $entity, bool $flush = true): void
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
    public function remove(MeasurementTypeDoctrine $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return MeasurementTypeDoctrine[] Returns an array of MeasurementTypeDoctrine objects
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
    public function findOneBySomeField($value): ?MeasurementTypeDoctrine
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
