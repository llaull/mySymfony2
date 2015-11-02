<?php

namespace ProgrammeTvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="ProgrammeTvBundle\Repository\ProgrammesRepository")
 * @ORM\Table(name="tv__programme")
 */
class Programme {

    public function __construct()
    {
        $this->idChannel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     *
     * @ORM\Column(type="integer", unique=true, nullable=true)
     */
    protected $pid;

    /**
     * @var datetime $start
     *
     * @ORM\Column(type="datetime")
     */
    protected $start;

    /**
     * @var datetime $stop
     *
     * @ORM\Column(type="datetime")
     */
    protected $stop;

    /**
     * @var \ProgrammeTvBundle\Entity\Channel
     *
     * @ORM\ManyToOne(targetEntity="ProgrammeTvBundle\Entity\Channel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_channel", referencedColumnName="id")
     * })
     */
    protected $idChannel;

    /**
     * @ORM\Column(type="string", length=190)
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $subTitle;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="text")
     */
    protected $category;


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
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Programme
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set stop
     *
     * @param \DateTime $stop
     *
     * @return Programme
     */
    public function setStop($stop)
    {
        $this->stop = $stop;

        return $this;
    }

    /**
     * Get stop
     *
     * @return \DateTime
     */
    public function getStop()
    {
        return $this->stop;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Programme
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subTitle
     *
     * @param string $subTitle
     *
     * @return Programme
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
     * Get subTitle
     *
     * @return string
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Programme
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Programme
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set idChannel
     *
     * @param \ProgrammeTvBundle\Entity\Channel $idChannel
     *
     * @return Programme
     */
    public function setIdChannel(\ProgrammeTvBundle\Entity\Channel $idChannel = null)
    {
        $this->idChannel = $idChannel;

        return $this;
    }

    /**
     * Get idChannel
     *
     * @return \ProgrammeTvBundle\Entity\Channel
     */
    public function getIdChannel()
    {
        return $this->idChannel;
    }


    /**
     * Set pid
     *
     * @param integer $pid
     *
     * @return Programme
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Get pid
     *
     * @return integer
     */
    public function getPid()
    {
        return $this->pid;
    }
}
