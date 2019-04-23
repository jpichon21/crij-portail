<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ContentBlock
 *
 * @ORM\Table(name="content_block")
 * @ORM\Entity()
 */
class ContentBlock
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255, nullable=true)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="Query")
     */
    private $queries;

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
     * @ORM\ManyToOne(targetEntity="Content", inversedBy="contentBlocks")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
    */
    private $content;

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
        $this->queries = new ArrayCollection();
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
     * Set type.
     *
     * @param string $type
     *
     * @return ContentBlock
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
     * Set title.
     *
     * @param string $title
     *
     * @return ContentBlock
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
     * Set text.
     *
     * @param string $text
     *
     * @return ContentBlock
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set content
     *
     * @param Content $content
     *
     * @return Content
     */
    public function setContent($content = null)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return Content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return ContentBlock
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
     * @return ContentBlock
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
     * Get queries.
     *
     * @return Collection
     */
    public function getQueries()
    {
        return $this->queries;
    }

    /**
     * Add query.
     *
     * @param Query $query
     *
     * @return ContentBlock
     */
    public function addQuery($query)
    {
        $this->queries[] = $query;

        return $this;
    }

    /**
     * Remove query.
     *
     * @param Query $query
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeQuery($query)
    {
        return $this->queries->removeElement($query);
    }

    /**
     * Set published.
     *
     * @param bool $published
     *
     * @return ContentBlock
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
