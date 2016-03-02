<?php

namespace Domotique\ReseauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Module
 *
 * @ORM\Table(name="domotique__module_notif")
 * @ORM\Entity
 */
class ModuleNotify
{
    /**
     * @var datetime $created
     *
     * @ORM\Column(type="datetime")
     */
    private $created;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var \Domotique\ReseauBundle\Entity\Log
     *
     * @ORM\ManyToOne(targetEntity="Domotique\ReseauBundle\Entity\Log")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="log_id", referencedColumnName="id")
     * })
     */
    private $log;
    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=100, nullable=true)
     */
    private $status;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * @return datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Log
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @param Log $log
     */
    public function setLog($log)
    {
        $this->log = $log;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


}
