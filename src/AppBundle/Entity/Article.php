<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity()
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     * @Serializer\Groups({"Article:list", "Article:details"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"Article:list", "Article:details"})
     * @Assert\NotNull
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="introduction", type="text", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"Article:list", "Article:details"})
     */
    private $introduction;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"Article:details"})
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Media", cascade={"persist"})
     * @ORM\JoinColumn(name="background_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Serializer\Expose()
     * @Serializer\Groups({"Article:details"})
     */
    private $background;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Section", cascade={"persist"})
     * @ORM\JoinColumn(name="section_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Serializer\Expose()
     * @Serializer\Groups({"Article:list", "Article:details"})
     */
    private $section;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="articles", cascade={"persist"})
     * @Serializer\Expose()
     * @Serializer\Groups({"Article:details"})
     */
    private $category;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(name="created", type="datetime")
     * @Serializer\Expose()
     * @Serializer\Groups({"Article:details"})
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updated", type="datetime")
     * @Serializer\Expose()
     * @Serializer\Groups({"Article:list", "Article:details"})
     */
    private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="archived", type="datetime", nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"Article:details"})
     */
    private $archived;

    /**
     * @var bool
     *
     * @ORM\Column(name="published", type="boolean", nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"Article:details"})
     */
    private $published;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="unpublished", type="datetime", nullable=true)
     */
    private $unpublished;

    public function __construct()
    {
        $this->published = false;
    }
    
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
     * @return Article
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
     * Set introduction.
     *
     * @param string $introduction
     *
     * @return Article
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;

        return $this;
    }

    /**
     * Get introduction.
     *
     * @return string
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
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
     * Get backgroundId.
     *
     * @return int
     */
    public function getBackgroundId(): ?int
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
    public function setBackground(?Media $background): self
    {
        $this->background = $background;

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
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return Article
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
     * @param \DateTime $updated
     *
     * @return Article
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated.
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set archived.
     *
     * @param \DateTime $archived
     *
     * @return Article
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Get archived.
     *
     * @return \DateTime
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Set published.
     *
     * @param bool $published
     *
     * @return Article
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

    /**
     * Set unpublished.
     *
     * @param \DateTime $unpublished
     *
     * @return Article
     */
    public function setUnpublished($unpublished)
    {
        $this->unpublished = $unpublished;

        return $this;
    }

    /**
     * Get unpublished.
     *
     * @return \DateTime
     */
    public function getUnpublished()
    {
        return $this->unpublished;
    }

    /**
     * Set section.
     *
     * @param Section|null $section
     *
     * @return Article
     */
    public function setSection($section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section.
     *
     * @return Section|null
     */
    public function getSection()
    {
        return $this->section;
    }
    
    /**
     * Set category.
     *
     * @param Category|null $category
     *
     * @return Article
     */
    public function setCategory($category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return Category|null
     */
    public function getCategory()
    {
        return $this->category;
    }
}
