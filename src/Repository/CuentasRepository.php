<?php

namespace App\Repository;

use App\Entity\Cuentas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cuentas>
 *
 * @method Cuentas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cuentas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cuentas[]    findAll()
 * @method Cuentas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuentasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cuentas::class);
    }

    //    /**
    //     * @return Cuentas[] Returns an array of Cuentas objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Cuentas
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
