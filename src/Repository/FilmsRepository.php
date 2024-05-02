<?php

namespace App\Repository;

use App\Entity\Films;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Films|null find($id, $lockMode = null, $lockVersion = null)
 * @method Films|null findOneBy(array $criteria, array $orderBy = null)
 * @method Films[]    findAll()
 * @method Films[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Films::class);
    }

    public function searchByTitre($query)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.titre LIKE :query')
            ->setParameter('query', $query.'%')
            ->orderBy('f.titre', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getStatsByCategorie()
    {
    $qb = $this->createQueryBuilder('f')
        ->select('c.nomcategorie as type, count(f) as count')
        ->leftJoin('f.categorieid', 'c')
        ->groupBy('c.nomcategorie'); 

    return $qb->getQuery()->getResult();
    }

}
