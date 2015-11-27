<?php

namespace ProgrammeTvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tv__channel")
 * @ORM\Entity(repositoryClass="ProgrammeTvBundle\Repository\ChannelRepository")
 */
class Channel {

    public function __construct()
    {
        $this->added = new \DateTime();
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=15, unique=true)
     */
    protected $idKazer;

    /**
     *
     * @ORM\Column(type="integer", unique=true, nullable=true)
     */
    protected $ordre;


    /**
     * @var datetime $ajouter
     *
     * @ORM\Column(type="datetime")
     */
    protected $added;

    /**
     *
     * @ORM\Column(type="string", length=20,unique=true)
     */
    protected $name;

    /**
     *
     * @ORM\Column(type="string", length=13,unique=true, nullable=true)
     */
    protected $codeTV;

    /**
     * @ORM\Column(type="integer", unique=true, nullable=true)
     */
    protected $codeZappette;

    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    protected $imageB64;

    /**
     * @return mixed
     */
    public function getImageB64()
    {
        return $this->imageB64;
    }

    /**
     * @param mixed $imageB64
     */
    public function setImageB64($imageB64)
    {
        $this->imageB64 = $imageB64;
    }

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
     * Set idKazer
     *
     * @param string $idKazer
     *
     * @return Channel
     */
    public function setIdKazer($idKazer)
    {
        $this->idKazer = $idKazer;

        return $this;
    }

    /**
     * Get idKazer
     *
     * @return string
     */
    public function getIdKazer()
    {
        return $this->idKazer;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Channel
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set added
     *
     * @param \DateTime $added
     *
     * @return Channel
     */
    public function setAdded($added)
    {
        $this->added = $added;

        return $this;
    }

    /**
     * Get added
     *
     * @return \DateTime
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Channel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set codeTV
     *
     * @param string $codeTV
     *
     * @return Channel
     */
    public function setCodeTV($codeTV)
    {
        $this->codeTV = $codeTV;

        return $this;
    }

    /**
     * Get codeTV
     *
     * @return string
     */
    public function getCodeTV()
    {
        return $this->codeTV;
    }

    /**
     * Set codeZappette
     *
     * @param integer $codeZappette
     *
     * @return Channel
     */
    public function setCodeZappette($codeZappette)
    {
        $this->codeZappette = $codeZappette;

        return $this;
    }

    /**
     * Get codeZappette
     *
     * @return integer
     */
    public function getCodeZappette()
    {
        return $this->codeZappette;
    }
}
