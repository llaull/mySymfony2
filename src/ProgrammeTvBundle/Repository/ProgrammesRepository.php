<?php

namespace ProgrammeTvBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProgrammesRepository extends EntityRepository{

    public function getToday()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM ProgrammeTvBundle:Programme p WHERE p.start >= :start ORDER BY p.start ASC'
            )
            ->setParameter('start', new \DateTime('today'), \Doctrine\DBAL\Types\Type::DATETIME)
            ->getResult();
    }

    public function getTomorrow()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM ProgrammeTvBundle:Programme p WHERE p.start >= :start ORDER BY p.start ASC'
            )
            ->setParameter('start', new \DateTime('+1 days'), \Doctrine\DBAL\Types\Type::DATETIME)
            ->getResult();
    }
}
