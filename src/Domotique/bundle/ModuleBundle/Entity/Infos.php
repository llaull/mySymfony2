<?php

namespace Domotique\bundle\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Infos
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Domotique\bundle\ModuleBundle\Repository\InfosRepository")*
 * @ORM\Table(name="domotique__module_infos",
 * uniqueConstraints={@ORM\UniqueConstraint(name="module_ref", columns={"module_ref"})}
 *
 * )
 */
//indexes={@ORM\Index(name="emplacement_id", columns={"emplacement_id"}),
//* @ORM\Table(name="domotique__module_infos", uniqueConstraints={@ORM\UniqueConstraint(name="module_ref", columns={"module_ref"}), indexes={@ORM\Index(name="emplacement_id", columns={"emplacement_id"})})



class Infos
{
    public function __toString()
    {
        return $this->moduleNom;
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
     * @var integer
     *
     * @ORM\Column(name="module_ref", type="integer", nullable=false)
     */
    private $moduleRef;

    /**
     * @var string
     *
     * @ORM\Column(name="module_nom", type="string", length=90, nullable=false)
     */
    private $moduleNom;

    /**
     * @var string
     *
     * @ORM\Column(name="nrf_id", type="string", length=15, nullable=false)
     */
    private $nrfId;

    /**
     * @var string
     *
     * @ORM\Column(name="module_type", type="text", length=65535, nullable=false)
     */
    private $moduleType;

    /**
     * @var \Domotique\bundle\ModuleBundle\Entity\Emplacement
     *
     * @ORM\ManyToOne(targetEntity="Domotique\bundle\ModuleBundle\Entity\Emplacement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emplacement_id", referencedColumnName="id")
     * })
     */
    private $emplacement;


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
     * Set moduleRef
     *
     * @param integer $moduleRef
     *
     * @return Infos
     */
    public function setModuleRef($moduleRef)
    {
        $this->moduleRef = $moduleRef;

        return $this;
    }

    /**
     * Get moduleRef
     *
     * @return integer
     */
    public function getModuleRef()
    {
        return $this->moduleRef;
    }

    /**
     * Set moduleNom
     *
     * @param string $moduleNom
     *
     * @return Infos
     */
    public function setModuleNom($moduleNom)
    {
        $this->moduleNom = $moduleNom;

        return $this;
    }

    /**
     * Get moduleNom
     *
     * @return string
     */
    public function getModuleNom()
    {
        return $this->moduleNom;
    }

    /**
     * Set nrfId
     *
     * @param integer $nrfId
     *
     * @return Infos
     */
    public function setNrfId($nrfId)
    {
        $this->nrfId = $nrfId;

        return $this;
    }

    /**
     * Get nrfId
     *
     * @return integer
     */
    public function getNrfId()
    {
        return $this->nrfId;
    }

    /**
     * Set moduleType
     *
     * @param string $moduleType
     *
     * @return Infos
     */
    public function setModuleType($moduleType)
    {
        $this->moduleType = $moduleType;

        return $this;
    }

    /**
     * Get moduleType
     *
     * @return string
     */
    public function getModuleType()
    {
        return $this->moduleType;
    }

    /**
     * Set emplacement
     *
     * @param \Domotique\bundle\ModuleBundle\Entity\Emplacement $emplacement
     *
     * @return Infos
     */
    public function setEmplacement(\Domotique\bundle\ModuleBundle\Entity\Emplacement $emplacement = null)
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    /**
     * Get emplacement
     *
     * @return \Domotique\bundle\ModuleBundle\Entity\Emplacement
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }
}
