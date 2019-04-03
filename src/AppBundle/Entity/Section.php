<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Section
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 *
 * @ORM\Table(name="section")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SectionRepository")
 */
class Section
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
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
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
     * @ORM\Column(name="thumb", type="string", length=255)
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
     * @ORM\OneToMany(targetEntity="Content", mappedBy="section")
    */
    private $content;

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
     * to string method
     *
     * @return string
    */
    public function __toString()
    {
        return $this->getTitle();
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
     * Set thumb.
     *
     * @param string $thumb
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
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
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
    public function addContent(\AppBundle\Entity\content $content)
    {
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
}
