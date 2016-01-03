<?php

namespace CarnetsBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class LieuRepository extends EntityRepository
{

    /**
     * return les coordonnees des lieux pour la carte de la premier page
     * @return array
     */
    public function allCoordonnee()
    {
        $fields = array(
            'L.id, L.lat, L.lng, L.ville');

        $query = $this->getEntityManager()->createQueryBuilder();
        $query
            ->select($fields)
            ->from('CarnetsBundle:Lieu', 'L')
            ->where('L.useInPath = 1');

        return $query
            ->getQuery()
            ->getResult();
    }

    /**
     * return des lieux avec une limit et en random
     * @return array
     */
    public function tagAll()
    {
        $em = $this->getEntityManager();
        $max = $em->createQuery('
            SELECT MAX(q.id) FROM CarnetsBundle:Lieu q
            ')
            ->getSingleScalarResult();
        return $em->createQuery('
            SELECT q.id, q.ville FROM CarnetsBundle:Lieu q
            WHERE q.id >= :rand AND q.useInPath = 1
            ORDER BY q.id ASC
            ')
            ->setParameter('rand', rand(0, $max))
            ->setMaxResults(10)
            ->getResult();
    }

    /**
     * @return array
     */
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

    /**
     * return les lieux selon l'id du carnet
     * @param $carnetId
     * @return array
     */
    public function findByCarnet($carnetId)
    {
        $fields = array(
            'l.id AS id',
            'l.ville',
            'l.slug AS villeSlug',
            'l.dateArrived',
            'l.dateDeparture',
            'l.imageHeader',
            'l.contenu',
            'c.slug AS carnetSlug'
        );

        $query = $this->getEntityManager()->createQueryBuilder();
        $query
            ->select($fields)
            ->from('CarnetsBundle:Lieu', 'l')
            ->leftjoin('l.carnet', 'c')
            ->where('l.carnet = ' . $carnetId . ' AND l.useInMenu = 1');

        return $query
            ->getQuery()
            ->getResult();
    }

}