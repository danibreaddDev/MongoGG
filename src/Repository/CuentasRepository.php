<?php

namespace App\Repository;

use App\Entity\Cuentas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;

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
    private $usuario;
    public function __construct(Security $user,ManagerRegistry $registry)
    {
        parent::__construct($registry, Cuentas::class);
        $this->usuario = $user->getUser();
    }
    public function paginacion($dql, $pagina, $elementoPorPagina)
    {
        $paginador = new Paginator($dql);
        $paginador->getQuery()->setFirstResult($elementoPorPagina * ($pagina - 1))->setMaxResults($elementoPorPagina);
        return $paginador;
    }
    public function buscarTodas($pagina = 1, $elementoPorPagina = 5)
    {
        $query =  $this->createQueryBuilder('t')
            ->addOrderBy('t.creadoEn', 'DESC')
            ->andWhere('t.Usuario = :Usuario')
            ->setParameter('Usuario', $this->usuario)
            ->getQuery();
        return $this->paginacion($query, $pagina, $elementoPorPagina);
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
