<?php
// src/Commun/UserBundle/Entity/User.php

namespace Commun\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="commun__user")
*/
class User extends BaseUser
{
   /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
   protected $id;

   public function __construct()
   {
       parent::__construct();
       // your own logic
   }
}