<?php

namespace CarnetsBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CarnetRepository extends EntityRepository
{

//    public function findAll()
//    {
//
//        $qb = $this->createQueryBuilder('p');
//        $qb->orderBy('p.added', 'DESC');
//
//        return $qb
//            ->getQuery()
//            ->getResult();
//    }

    public function findPath($em,$carnetId)
    {
        $rq = "SELECT ville,lat,lng,date_arrived,date_departure,slug FROM carnet2voyage__lieux WHERE carnet_id = $carnetId AND use_in_path IS true ORDER BY date_arrived ASC";

        $connection = $em->getConnection();
        $statement = $connection->prepare($rq);
        $statement->execute();
        $results = $statement->fetchAll();

        return $results;
    }
}