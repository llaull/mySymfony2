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
 * @ORM\Table(name="carnet2voyage__lieux")
 * @ORM\Entity(repositoryClass="CarnetsBundle\Repository\LieuRepository")
 */
class Lieu
{
    public function __construct()
    {
        $this->carnet = new ArrayCollection();
        $this->created = new \DateTime();
    }

    public function __toString()
    {
        return $this->ville;
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
    protected $ville;

    /**
     * @var carnet
     *
     * @ORM\ManyToOne(targetEntity="Carnet")
     * @ORM\JoinColumn(name="carnet_id", referencedColumnName="id", nullable=false)
     */
    private $carnet;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50, unique=true)
     * @Gedmo\Slug(fields={"ville"}, unique=true)
     */
    protected $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contenu;

    /**
     * @ORM\Column(type="string",length=200, nullable=true)
     */
    protected $image;

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
     * @return Lieu
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
     * Set ville
     *
     * @param string $ville
     *
     * @return Lieu
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set carnet
     *
     * @param \CarnetsBundle\Entity\Carnet $carnet
     *
     * @return Lieu
     */
    public function setCarnet(\CarnetsBundle\Entity\Carnet $carnet = null)
    {
        $this->carnet = $carnet;

        return $this;
    }

    /**
     * Get carnet
     *
     * @return \CarnetsBundle\Entity\Carnet
     */
    public function getCarnet()
    {
        return $this->carnet;
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Lieu
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Lieu
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
     * Set image
     *
     * @param string $image
     *
     * @return Lieu
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
}
