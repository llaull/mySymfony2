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
        return '('.$this->carnet.') '.$this->ville;
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
     * @var datetime $dateArrived
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $dateArrived;

    /**
     * @var datetime $dateDeparture
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $dateDeparture;


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
     * @return datetime
     */
    public function getDateArrived()
    {
        return $this->dateArrived;
    }

    /**
     * @param datetime $dateArrived
     */
    public function setDateArrived($dateArrived)
    {
        $this->dateArrived = $dateArrived;
    }

    /**
     * @return datetime
     */
    public function getDateDeparture()
    {
        return $this->dateDeparture;
    }

    /**
     * @param datetime $dateDeparture
     */
    public function setDateDeparture($dateDeparture)
    {
        $this->dateDeparture = $dateDeparture;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return carnet
     */
    public function getCarnet()
    {
        return $this->carnet;
    }

    /**
     * @param carnet $carnet
     */
    public function setCarnet($carnet)
    {
        $this->carnet = $carnet;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * @param mixed $ordre
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param mixed $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * @return mixed
     */
    public function getUseInMenu()
    {
        return $this->useInMenu;
    }

    /**
     * @param mixed $useInMenu
     */
    public function setUseInMenu($useInMenu)
    {
        $this->useInMenu = $useInMenu;
    }

    /**
     * @return mixed
     */
    public function getUseInPath()
    {
        return $this->useInPath;
    }

    /**
     * @param mixed $useInPath
     */
    public function setUseInPath($useInPath)
    {
        $this->useInPath = $useInPath;
    }

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $ordre;

    /**
     * @ORM\Column(type="string", nullable=TRUE)
     */
    protected $lat;

    /**
     * @ORM\Column(type="string", nullable=TRUE)
     */
    protected $lng;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $useInMenu;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $useInPath;
}
