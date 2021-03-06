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
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity()
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Category implements RouteReferrersInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     * @Serializer\Groups({"Category:list", "Category:details", "Section:list"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"Category:list", "Category:details"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"Category:details"})
     */
    private $intro;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"Category:list", "Category:details"})
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"Category:list", "Category:details"})
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="footer", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"Category:details"})
     */
    private $footer;

    /**
    * @ORM\OneToMany(targetEntity="Section", mappedBy="category", orphanRemoval=true)
    * @Serializer\Expose()
    * @Serializer\Groups({"Category:list", "Category:details"})
    */
    private $sections;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="category", cascade={"persist"})
     * @Serializer\Expose()
     * @Serializer\Groups({"Category:details", "Article:list"})
    */
    private $articles;

    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="logo_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Serializer\Expose()
     * @Serializer\Groups({"Category:list", "Category:details"})
     */
    private $logo;


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
     * @var string
     *
     * @Gedmo\Slug(fields={"title"}, updatable=false, unique=false)
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=false)
     */
    private $slug;

    /**
     * var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"Category:list", "Category:details"})
     */
    private $color;

    /**
     * Constructor
    */
    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->routes = new ArrayCollection();
    }

    /**
     * to string method
     * @return string
    */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * get class Name
     * @return string
     */
    public function getClassName()
    {
        $path = explode('\\', __CLASS__);
        return array_pop($path);
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
     * @return Category
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
     * @return Category
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
     * @return Category
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
     * Set domain.
     *
     * @param string $domain
     *
     * @return Category
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain.
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set footer.
     *
     * @param string $footer
     *
     * @return Category
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * Get footer.
     *
     * @return string
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * Get sections
     *
     * @return Collection
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Add sections
     *
     * @param Section $sections
     *
     * @return Category
     */
    public function addSections($sections)
    {
        $this->sections[] = $sections;

        return $this;
    }

    /**
     * Remove sections
     *
     * @param Section $sections
     */
    public function removeSections($sections)
    {
        $this->sections->removeElement($sections);
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
     * @return Category
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

    public function setArticles($articles)
    {
        $this->articles = $articles;
        return $this;
    }

    /**
     * Set logoId.
     *
     * @param int $logoId
     *
     * @return Category
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
     * @return Category
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
     * Set slug.
     *
     * @param string $slug
     *
     * @return Category
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
     * Set published.
     *
     * @param bool $published
     *
     * @return Category
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
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
     * Get published.
     *
     * @return bool
     */
    public function getPublished()
    {
        return $this->published;
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
}
