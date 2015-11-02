<?php

namespace Domotique\bundle\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SondeUnit
 *
 * @ORM\Table(name="domotique__sonde_unit")
 * @ORM\Entity
 */
class SondeUnit
{
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
     * @ORM\Column(name="symbole", type="string", length=90, nullable=false)
     */
    private $symbole;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=90, nullable=false)
     */
    private $slug;



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
     * Set symbole
     *
     * @param string $symbole
     *
     * @return SondeUnit
     */
    public function setSymbole($symbole)
    {
        $this->symbole = $symbole;

        return $this;
    }

    /**
     * Get symbole
     *
     * @return string
     */
    public function getSymbole()
    {
        return $this->symbole;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return SondeUnit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return SondeUnit
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
