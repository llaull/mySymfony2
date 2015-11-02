<?php

namespace TclBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LigneRepository extends EntityRepository{

    public function findAll()
    {

        $qb = $this->createQueryBuilder('p');
        $qb->orderBy('p.type', 'DESC', 'p.description', 'ASC')
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}