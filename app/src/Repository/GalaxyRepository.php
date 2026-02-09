<?php

namespace App\Repository;

use App\Entity\Galaxy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class GalaxyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Galaxy::class);
    }
        public function findCarouselData()
    {
        return $this->createQueryBuilder('g')
            ->leftJoin('g.modeles', 'm')
            ->leftJoin('m.modelesFiles', 'mf')
            ->leftJoin('mf.directusFiles', 'df')
            ->select('g.title', 'g.description', 'df.filename_disk')
            ->orderBy('g.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
