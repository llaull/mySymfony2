<?php
/* run
*  php app/console doctrine:schema:update --force
*  php app/console doctrine:generate:entities AlertBundle/Entity/
*  php app/console generate:doctrine:crud
// $this->date = new \DateTime();
*/

namespace CarnetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
* @ORM\Entity
* @ORM\Table(name="carnet2voyage__Page")
* @ORM\Entity(repositoryClass="CarnetsBundle\Repository\PageRepository")
*/
class Page
{

    public function __construct()
    {
        $this->lieu = new ArrayCollection();
        $this->created = new \DateTime();
    }

    public function __toString()
    {
        return $this->titre;
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
     * @ORM\Column(type="string", length=90)
     */
    protected $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contenu;

    /**
     * @ORM\Column(type="string",length=200, nullable=true)
     */
    protected $image;

    /**
     * @var LieuPage
     *
     * @ORM\ManyToOne(targetEntity="Lieu")
     * @ORM\JoinColumn(name="lieu_id", referencedColumnName="id", nullable=false)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50, unique=true)
     * @Gedmo\Slug(fields={"titre"}, unique=true)
     */
    protected $slug;

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
     * @return Page
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Page
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Page
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set lieu
     *
     * @param \CarnetsBundle\Entity\Lieu $lieu
     *
     * @return Page
     */
    public function setLieu(\CarnetsBundle\Entity\Lieu $lieu = null)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return \CarnetsBundle\Entity\Lieu
     */
    public function getLieu()
    {
        return $this->lieu;
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

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Page
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Page
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
