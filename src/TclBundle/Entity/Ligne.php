<?php
/* run
*  php app/console doctrine:schema:update --force
*  php app/console doctrine:generate:entities AlertBundle/Entity/
*  php app/console generate:doctrine:crud
// $this->date = new \DateTime();
*/

namespace TclBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tcl__ligne")
 * @ORM\Entity(repositoryClass="TclBundle\Repository\LigneRepository")
 */
class Ligne
{

    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var datetime $added
     *
     * @ORM\Column(type="datetime")
     */
    protected $added;

    /**
     * @ORM\Column(type="string", length=90)
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=90)
     */
    protected $description;

    /**
     * @ORM\ManyToMany(targetEntity="Commun\UserBundle\Entity\User")
     * @ORM\JoinTable(name="tcl__ligne_user",
     *      joinColumns={@ORM\JoinColumn(name="ligne_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     *      )
     **/
    protected $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
     * Set added
     *
     * @param \DateTime $added
     *
     * @return Ligne
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
     * Set type
     *
     * @param string $type
     *
     * @return Ligne
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Ligne
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
}
