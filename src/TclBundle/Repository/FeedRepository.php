<?php

namespace TclBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FeedRepository extends EntityRepository{

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