<?php

namespace Domotique\bundle\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table(name="domotique__TaskLog")
 * @ORM\Entity
 */
class Log
{

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->idTask = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->reponse;
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var datetime $created
     *
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     *
     * @ORM\Column(type="string", unique=false)
     */
    protected $source;

    /**
     *
     * @ORM\Column(type="string", unique=false)
     */
    protected $destination;

    /**
     *
     * @ORM\Column(type="string", unique=false)
     */
    protected $reponse;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Task")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="task_id", referencedColumnName="id")
     * })
     */
    protected $idTask;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Log
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return Log
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set destination
     *
     * @param string $destination
     *
     * @return Log
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set reponse
     *
     * @param string $reponse
     *
     * @return Log
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set idTask
     *
     * @param \Domotique\Bundle\TaskBundle\Entity\Task $idTask
     *
     * @return Log
     */
    public function setIdTask(\Domotique\Bundle\TaskBundle\Entity\Task $idTask = null)
    {
        $this->idTask = $idTask;

        return $this;
    }

    /**
     * Get idTask
     *
     * @return \Domotique\Bundle\TaskBundle\Entity\Task
     */
    public function getIdTask()
    {
        return $this->idTask;
    }
}
