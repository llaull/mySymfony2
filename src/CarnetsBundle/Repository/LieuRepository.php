<?php

namespace CarnetsBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class LieuRepository extends EntityRepository
{

    public function findAll()
    {
        $fields = array(
            'l.id AS id',
            'l.ville',
            'l.slug AS villeSlug',
            'c.title AS carnet',
            'c.slug AS carnetSlug',
            'c.destination');

        $query = $this->getEntityManager()->createQueryBuilder();
        $query
            ->select($fields)
            ->from('CarnetsBundle:Lieu', 'l')
            ->leftjoin('l.carnet', 'c');

        return $query
            ->getQuery()
            ->getResult();
    }
}