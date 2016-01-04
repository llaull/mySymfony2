<?php
/**
 * Created by PhpStorm.
 * User: moi
 * Date: 03/01/2016
 * Time: 19:39
 */
namespace CarnetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="carnet2voyage__blogArticle")
 */
class BlogArticle
{
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
     * @var datetime $modified
     *
     * @ORM\Column(type="datetime")
     */
    protected $modified;
    /**
     * @ORM\Column(type="string", length=90)
     */
    protected $title;
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=90, unique=true)
     * @Gedmo\Slug(fields={"title"}, unique=true)
     */
    protected $slug;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contenu;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $useInMenu;

}
