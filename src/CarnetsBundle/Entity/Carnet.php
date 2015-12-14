<?php
/* run
*  php app/console doctrine:schema:update --force
*  php app/console doctrine:generate:entities CarnetBundle/Entity/
*  php app/console generate:doctrine:crud
// $this->date = new \DateTime();
*/

namespace CarnetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="carnet2voyage__carnets")
 * @ORM\Entity(repositoryClass="CarnetsBundle\Repository\CarnetRepository")
 */
class Carnet
{

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->depart = new \DateTime();
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
     * @var datetime $created
     *
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @var datetime $depart
     *
     * @ORM\Column(type="datetime")
     */
    protected $depart;


    /**
     * @ORM\Column(type="string", length=90, nullable=false)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=90,nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="string", length=90,nullable=true)
     */
    protected $destination;

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
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
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
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param mixed $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50, unique=true)
     * @Gedmo\Slug(fields={"title"}, unique=true)
     */
    protected $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contenu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true))
     *
    */
    protected $imageName;

    /**
     * @return datetime
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * @param datetime $depart
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;
    }

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $actived;

    /**
     * @return mixed
     */
    public function getActived()
    {
        return $this->actived;
    }

    /**
     * @param mixed $actived
     */
    public function setActived($actived)
    {
        $this->actived = $actived;
    }
}
