<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 20/12/2015
 * Time: 21:21
 */

namespace CarnetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="carnet2voyage__generalOption")
 */
class GeneralOption
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     * @var datetime $modified
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $modified;
    /**
     * @var texteFooter
     * @ORM\Column(type="text", nullable=true)
     */
    protected $footer;

    public function __construct()
    {
        $this->modified = new \DateTime();
    }

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
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param datetime $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    /**
     * @return texteFooter
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * @param texteFooter $footer
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;
    }
}
