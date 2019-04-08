<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Content
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 *
 * @ORM\Table(name="content")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContentRepository")
 */
class Content
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
     * @ORM\OneToMany(targetEntity="ContentBlock", mappedBy="content", cascade={"persist"})
    */
    private $contentBlock;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

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
     * Set intro.
     *
     * @param string $intro
     *
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
     *
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
     * Set section
     *
     * @param \AppBundle\Entity\Section $section
     *
     * @return Section
     */
    public function setSection(\AppBundle\Entity\Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \AppBundle\Entity\Section
     */
    public function getSection()
    {
        return $this->section;
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
     * Set deletedAt.
     *
     * @param timestamp $deletedAt
     *
     * @return Category
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
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
     * @return Category
     */
    public function setLogoId(?int $logoId): self
    {
        $this->logoId = $logoId;

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
     * Set backgroundId.
     *
     * @param int $backgroundId
     *
     * @return Content
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
     * @return Content
     */
    public function setBackground(?Media $background): self
    {
        $this->background = $background;

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
     * @return Category
     */
    public function setLogo(?Media $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Add contentBlock
     *
     * @param \AppBundle\Entity\ContentBlock $contentBlock
     *
     * @return Category
     */
    public function addContentBlock(\AppBundle\Entity\ContentBlock $contentBlock)
    {
        $contentBlock->setContent($this);
        $this->contentBlock[] = $contentBlock;

        return $this;
    }

    /**
     * Remove contentBlock
     *
     * @param \AppBundle\Entity\ContentBlock $contentBlock
     *
     * @return ContentBlock
     */
    public function removeContentBlock(\AppBundle\Entity\ContentBlock $contentBlock)
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
     *
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContentBlock()
    {
        return $this->contentBlock;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contentBlock = new \Doctrine\Common\Collections\ArrayCollection();
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
