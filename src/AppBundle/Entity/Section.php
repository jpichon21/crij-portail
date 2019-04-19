<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use Symfony\Cmf\Component\Routing\RouteReferrersInterface;

/**
 * Section
 *
 * @ORM\Table(name="section")
 * @ORM\Entity()
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 * @Serializer\ExclusionPolicy("all")
 */
class Section implements RouteReferrersInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     * @Serializer\Groups({"Section:list", "Section:details", "Article:list", "Article:details"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"Section:list", "Section:details"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"Section:details"})
     */
    private $intro;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"Section:list", "Section:details"})
     */
    private $link;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"}, updatable=false, unique=false)
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"Section:list", "Section:details"})
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist"})
     * @Serializer\Expose()
     * @Serializer\Groups({"Section:list", "Section:details"})
     */
    private $thumb;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(type="datetime", nullable = true)
     */
    protected $updated;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="sections")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Serializer\Expose()
     * @Serializer\Groups({"Section:details", "Section:list"})
    */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="Content", mappedBy="section", cascade={"persist"})
     * @Serializer\Expose()
     * @Serializer\Groups({"Section:details"})
    */
    private $contents;

    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist"})
     * @Serializer\Expose()
     * @Serializer\Groups({"Section:details"})
     */
    private $background;

    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist"})
     * @Serializer\Expose()
     * @Serializer\Groups({"Section:list", "Section:details"})
     */
    private $logo;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="section", cascade={"persist"})
     * @Serializer\Expose()
     * @Serializer\Groups({"Section:details", "Article:list"})
    */
    private $articles;

    /**
     * @var RouteObjectInterface[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route", cascade={"all"})
    */
    private $routes;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $published;

    /**
     * to string method
     *
     * @return string
    */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Constructor
    */
    public function __construct()
    {
        $this->contents = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->routes = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     * @return Section
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set intro.
     *
     * @param string $intro
     *
     * @return Section
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro.
     *
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set link.
     *
     * @param string $link
     *
     * @return Section
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return Section
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set color.
     *
     * @param string $color
     *
     * @return Section
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color.
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set thumbId.
     *
     * @param int $thumbId
     *
     * @return Section
     */
    public function setThumbId($thumbId)
    {
        $this->thumbId = $thumbId;

        return $this;
    }

    /**
     * Get thumbId.
     *
     * @return int
     */
    public function getThumbId()
    {
        return $this->thumbId;
    }

    /**
     * Set thumb.
     *
     * @param Media $thumb
     *
     * @return Section
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     * Get thumb.
     *
     * @return Media
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * Set category
     *
     * @param Category $category
     *
     * @return Category
     */
    public function setCategory($category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Get contents
     *
     * @return ArrayCollection
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * Add contents
     *
     * @param Content $contents
     *
     * @return Category
     */
    public function addContents($contents)
    {
        $contents->setSection($this);
        $this->contents[] = $contents;

        return $this;
    }

    /**
     * Remove contents
     *
     * @param Content $contents
     */
    public function removeContents($contents)
    {
        $this->contents->removeElement($contents);
    }

    /**
     * Set backgroundId.
     *
     * @param int $backgroundId
     *
     * @return Section
     */
    public function setBackgroundId($backgroundId)
    {
        $this->backgroundId = $backgroundId;

        return $this;
    }

    /**
     * Get backgroundId.
     *
     * @return int
     */
    public function getBackgroundId()
    {
        return $this->backgroundId;
    }

    /**
     * Set background.
     *
     * @param Media $background
     *
     * @return Section
     */
    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background.
     *
     * @return Media
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set logoId.
     *
     * @param int $logoId
     *
     * @return Section
     */
    public function setLogoId($logoId)
    {
        $this->logoId = $logoId;

        return $this;
    }

    /**
     * Get logoId.
     *
     * @return int
     */
    public function getLogoId()
    {
        return $this->logoId;
    }

    /**
     * Set logo.
     *
     * @param Media $logo
     *
     * @return Section
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo.
     *
     * @return Media
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set deletedAt.
     *
     * @param Timestamp $deletedAt
     *
     * @return timestamp
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * Get deletedAt.
     *
     * @return Section
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return Section
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created.
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated.
     *
     * @param \DateTime|null $updated
     *
     * @return Section
     */
    public function setUpdated($updated = null)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated.
     *
     * @return \DateTime|null
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Get articles.
     *
     * @return ArrayCollection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add article.
     *
     * @param Article $article
     *
     * @return Section
     */
    public function addArticle($article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article.
     *
     * @param Article $article
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeArticle($article)
    {
        return $this->articles->removeElement($article);
    }

    /**
     * Set routes collection
     *
     * @param RouteObjectInterface[]|ArrayCollection $routes
     * @return $this
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
        return $this;
    }

    /**
     * Get routes collection
     *
     * @return RouteObjectInterface[]|ArrayCollection
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Add route to routes collection
     *
     * @param RouteObjectInterface $route
     * @return $this
     */
    public function addRoute($route)
    {
        $this->routes[] = $route;
    }

    /**
     * Remove route from routes collection
     *
     * @param RouteObjectInterface $route
     * @return $this
     */
    public function removeRoute($route)
    {
        $this->routes->removeElement($route);
        return $this;
    }

    /**
     * Set published.
     *
     * @param bool $published
     *
     * @return Section
     */
    
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published.
     *
     * @return bool
     */
    public function getPublished()
    {
        return $this->published;
    }
}
