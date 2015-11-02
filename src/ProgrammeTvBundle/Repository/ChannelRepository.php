<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 14/10/2015
 * Time: 11:34
 */

namespace ProgrammeTvBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ChannelRepository extends EntityRepository{

    public function findAll()
    {
        return $this->findBy(array(), array('ordre' => 'ASC'));
    }
}