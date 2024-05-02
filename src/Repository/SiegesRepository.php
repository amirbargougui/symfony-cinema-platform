<?php

namespace App\Repository;

use App\Entity\Sieges;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sieges|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sieges|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sieges[]    findAll()
 * @method Sieges[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiegesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sieges::class);
    }

    // Ajoutez ici vos méthodes personnalisées si nécessaire
}
