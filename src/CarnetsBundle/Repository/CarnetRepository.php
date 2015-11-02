<?php

namespace CarnetsBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CarnetRepository extends EntityRepository{

    public function findAll()
    {

        $qb = $this->createQueryBuilder('p');
        $qb->orderBy('p.added', 'DESC')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}