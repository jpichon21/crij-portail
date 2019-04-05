<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use Symfony\Cmf\Component\Routing\RouteReferrersInterface;

/**
 * Section
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 *
 * @ORM\Table(name="section")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SectionRepository")
 */
class Section implements RouteReferrersInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="string", length=255)
     */
    private $intro;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
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
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist"})
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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="rubric")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
    */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="Content", mappedBy="section", cascade={"persist"})
    */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist"})
     */
    private $background;

    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist"})
     */
    private $logo;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="News", mappedBy="section", cascade={"persist"})
    */
    private $news;

    /**
     * @var RouteObjectInterface[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route", cascade={"all"})
    */
    private $routes;

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
        $this->content = new \Doctrine\Common\Collections\ArrayCollection();
        $this->news = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
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
     * Get thumbId.
     *
     * @return int
     */
    public function getThumbId(): ?int
    {
        return $this->thumbId;
    }

    /**
     * Set thumbId.
     *
     * @param int $thumbId
     *
     * @return Section
     */
    public function setThumbId(?int $thumbId): self
    {
        $this->thumbId = $thumbId;

        return $this;
    }

    /**
     * Get thumb.
     *
     * @return Media
     */
    public function getThumb(): ?Media
    {
        return $this->thumb;
    }

    /**
     * Set thumb.
     *
     * @param Media $thumb
     *
     * @return Section
     */
    public function setThumb(?Media $thumb): self
    {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Category
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add content
     *
     * @param \AppBundle\Entity\Content $content
     *
     * @return Category
     */
    public function addContent(\AppBundle\Entity\Content $content)
    {
        $content->setSection($this);
        $this->content[] = $content;

        return $this;
    }

    /**
     * Remove content
     *
     * @param \AppBundle\Entity\Content $content
     */
    public function removeContent(\AppBundle\Entity\Content $content)
    {
        $this->content->removeElement($content);
    }

    /**
     * Get content
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get backgroundId.
     *
     * @return int
     */
    public function getBackgroundId(): ?int
    {
        return $this->backgroundId;
    }

    /**
     * Set backgroundId.
     *
     * @param int $backgroundId
     *
     * @return Section
     */
    public function setBackgroundId(?int $backgroundId): self
    {
        $this->backgroundId = $backgroundId;

        return $this;
    }

    /**
     * Get background.
     *
     * @return Media
     */
    public function getBackground(): ?Media
    {
        return $this->background;
    }

    /**
     * Set background.
     *
     * @param Media $background
     *
     * @return Section
     */
    public function setBackground(?Media $background): self
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get logoId.
     *
     * @return int
     */
    public function getLogoId(): ?int
    {
        return $this->logoId;
    }

    /**
     * Set logoId.
     *
     * @param int $logoId
     *
     * @return Section
     */
    public function setLogoId(?int $logoId): self
    {
        $this->logoId = $logoId;

        return $this;
    }

    /**
     * Get logo.
     *
     * @return Media
     */
    public function getLogo(): ?Media
    {
        return $this->logo;
    }

    /**
     * Set logo.
     *
     * @param Media $logo
     *
     * @return Section
     */
    public function setLogo(?Media $logo): self
    {
        $this->logo = $logo;

        return $this;
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
     * Get deletedAt.
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
     * Add news.
     *
     * @param \AppBundle\Entity\News $news
     *
     * @return Section
     */
    public function addNews(\AppBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news.
     *
     * @param \AppBundle\Entity\News $news
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeNews(\AppBundle\Entity\News $news)
    {
        return $this->news->removeElement($news);
    }

    /**
     * Get news.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNews()
    {
        return $this->news;
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
     * Add route to routes collection
     *
     * @param RouteObjectInterface $route
     * @return $this
     */
    public function addRoute($route)
    {
        $this->routes[] = $route;
        return $this;
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
}
