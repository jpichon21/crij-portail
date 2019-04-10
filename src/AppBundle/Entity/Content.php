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
 * Content
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 *
 * @ORM\Table(name="content")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContentRepository")
 */
class Content implements RouteReferrersInterface
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"}, updatable=false, unique=false)
     * @ORM\Column(name="slug", type="string", length=255, unique=false)
     */
    private $slug;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable = true)
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity="Section", inversedBy="content")
     * @ORM\JoinColumn(name="section_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
    */
    private $section;

    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist", "remove"})
     */
    private $background;

    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist", "remove"})
     */
    private $logo;


    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var RouteObjectInterface[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route",
     *  cascade={"persist", "remove"})
    */
    private $routes;
    
    /**
     * @ORM\OneToMany(targetEntity="ContentBlock", mappedBy="content", cascade={"persist"})
    */
    private $contentBlock;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * Constructor
    */
    public function __construct()
    {
        $this->routes = new ArrayCollection();
        $this->contentBlock = new ArrayCollection();
    }

    /**
     * to string method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getIntro();
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
     * @return Content
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
     * Set type.
     *
     * @param string $type
     * @return Content
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     * @return Content
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
     * Set section
     *
     * @param Section $section
     * @return Section
     */
    public function setSection($section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set deletedAt.
     *
     * @param timestamp $deletedAt
     * @return Category
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * Get deletedAt.
     *
     * @return timestamp
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
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
     * Set logoId.
     *
     * @param int $logoId
     * @return Category
     */
    public function setLogoId($logoId)
    {
        $this->logoId = $logoId;

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
     * Set backgroundId.
     *
     * @param int $backgroundId
     * @return Content
     */
    public function setBackgroundId($backgroundId)
    {
        $this->backgroundId = $backgroundId;

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
     * Set background.
     *
     * @param Media $background
     * @return Content
     */
    public function setBackground($background)
    {
        $this->background = $background;

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
     * Set logo.
     *
     * @param Media $logo
     * @return Category
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Add contentBlock
     *
     * @param ContentBlock $contentBlock
     * @return Category
     */
    public function addContentBlock($contentBlock)
    {
        $contentBlock->setContent($this);
        $this->contentBlock[] = $contentBlock;

        return $this;
    }

    /**
     * Remove contentBlock
     *
     * @param ContentBlock $contentBlock
     * @return ContentBlock
     */
    public function removeContentBlock($contentBlock)
    {
        if ($this->contentBlock->contains($contentBlock)) {
            $this->contentBlock->removeElement($contentBlock);
        }

        return $this;
    }

    /**
     * Set contentBlock.
     *
     * @param string $contentBlock
     * @return Content
     */
    public function setContentBlock($contentBlock)
    {
        $this->contentBlock = $contentBlock;

        return $this;
    }

    /**
     * Get contentBlock
     *
     * @return ContentBlock
     */
    public function getContentBlock()
    {
        return $this->contentBlock;
    }

    /**
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return Content
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
     * @return Content
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

    /**
     * Set isPublished.
     *
     * @param bool $isPublished
     *
     * @return Content
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished.
     *
     * @return bool
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }
}
