<?php

namespace Commun\ToDoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="commun__todo")
 */
class Todo
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Commun\UserBundle\Entity\user
     *
     * @ORM\ManyToOne(targetEntity="Commun\UserBundle\Entity\user")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    protected $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added", type="datetime", nullable=false)
     */
    protected $added;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=true)
     */
    protected $modified;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=90, nullable=false)
     */
    protected $value;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", length=90, nullable=false)
     */
    protected $status;

    /**
     * @return boolean
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param boolean $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    public function __construct()
    {
        $this->added = new \DateTime();
        $this->modified = new \DateTime();
    }

    public function __toString()
    {
        return $this->value;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Commun\UserBundle\Entity\user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \Commun\UserBundle\Entity\user $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return \DateTime
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * @param \DateTime $added
     */
    public function setAdded($added)
    {
        $this->added = $added;
    }

    /**
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param \DateTime $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }



}