<?php

namespace Domotique\bundle\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Domotique\ReseauBundle\Entity\Module;
/**
 * Logs
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Domotique\bundle\ModuleBundle\Repository\LogsRepository")
 * @ORM\Table(name="domotique__module_logs", indexes={@ORM\Index(name="modules_id", columns={"modules_id"}), @ORM\Index(name="sonde_type", columns={"sonde_type"}), @ORM\Index(name="sonde_unit", columns={"sonde_unit"})})
 */
class Logs
{

    public function __construct()
    {
        $this->temps = new \DateTime();
        $this->created = new \DateTime();
    }

    public function __toString()
    {
        return $this->temps.' - '.$this->sondeValeur;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sonde_valeur", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $sondeValeur;

    /**
     * @var integer
     *
     * @ORM\Column(name="sonde_id", type="integer", nullable=true)
     */
    private $sondeId;

    /**
     * @var datetime $created
     *
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="temps", type="datetime", nullable=false)
     */
    private $temps;

    /**
     * @var \Domotique\ReseauBundle\Entity\Module
     *
     * @ORM\ManyToOne(targetEntity="Domotique\ReseauBundle\Entity\Module")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modules_id", referencedColumnName="id")
     * })
     */
    private $modules;

    /**
     * @var \Domotique\bundle\ModuleBundle\Entity\SondeType
     *
     * @ORM\ManyToOne(targetEntity="Domotique\bundle\ModuleBundle\Entity\SondeType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sonde_type", referencedColumnName="id")
     * })
     */
    private $sondeType;

    /**
     * @var \Domotique\bundle\ModuleBundle\Entity\SondeUnit
     *
     * @ORM\ManyToOne(targetEntity="Domotique\bundle\ModuleBundle\Entity\SondeUnit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sonde_unit", referencedColumnName="id")
     * })
     */
    private $sondeUnit;



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
     * Set sondeValeur
     *
     * @param string $sondeValeur
     *
     * @return Logs
     */
    public function setSondeValeur($sondeValeur)
    {
        $this->sondeValeur = $sondeValeur;

        return $this;
    }

    /**
     * Get sondeValeur
     *
     * @return string
     */
    public function getSondeValeur()
    {
        return $this->sondeValeur;
    }

    /**
     * Set sondeId
     *
     * @param integer $sondeId
     *
     * @return Logs
     */
    public function setSondeId($sondeId)
    {
        $this->sondeId = $sondeId;

        return $this;
    }

    /**
     * Get sondeId
     *
     * @return integer
     */
    public function getSondeId()
    {
        return $this->sondeId;
    }

    /**
     * Set temps
     *
     * @param \DateTime $temps
     *
     * @return Logs
     */
    public function setTemps($temps)
    {
        $this->temps = $temps;

        return $this;
    }

    /**
     * Get temps
     *
     * @return \DateTime
     */
    public function getTemps()
    {
        return $this->temps;
    }

    /**
     * Set modules
     *
     * @param \Domotique\ReseauBundle\Entity\Module $modules
     *
     * @return Logs
     */
    public function setModules(\Domotique\ReseauBundle\Entity\Module $modules = null)
    {
        $this->modules = $modules;

        return $this;
    }

    /**
     * Get modules
     *
     * @return \Domotique\ReseauBundle\Entity\Module
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Set sondeType
     *
     * @param \Domotique\bundle\ModuleBundle\Entity\SondeType $sondeType
     *
     * @return Logs
     */
    public function setSondeType(\Domotique\bundle\ModuleBundle\Entity\SondeType $sondeType = null)
    {
        $this->sondeType = $sondeType;

        return $this;
    }

    /**
     * Get sondeType
     *
     * @return \Domotique\bundle\ModuleBundle\Entity\SondeType
     */
    public function getSondeType()
    {
        return $this->sondeType;
    }

    /**
     * Set sondeUnit
     *
     * @param \Domotique\bundle\ModuleBundle\Entity\SondeUnit $sondeUnit
     *
     * @return Logs
     */
    public function setSondeUnit(\Domotique\bundle\ModuleBundle\Entity\SondeUnit $sondeUnit = null)
    {
        $this->sondeUnit = $sondeUnit;

        return $this;
    }

    /**
     * Get sondeUnit
     *
     * @return \Domotique\bundle\ModuleBundle\Entity\SondeUnit
     */
    public function getSondeUnit()
    {
        return $this->sondeUnit;
    }
}
