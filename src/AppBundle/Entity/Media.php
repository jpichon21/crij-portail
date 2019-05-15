<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 *
 * @Gedmo\Uploadable(
 *  allowOverwrite=false,
 *  filenameGenerator="SHA1",
 *  appendNumber=true,
 *  allowedTypes="image/jpeg,image/jpg,image/pjpeg,image/png,image/x-png"
 * )
 * @Serializer\ExclusionPolicy("NONE")
 */
class Media
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column
     *
     * @Gedmo\UploadableFilePath
     * @Serializer\Expose()
     * @Serializer\Groups({
     * "Category:list",
     * "Category:details",
     * "Section:list",
     * "Section:details",
     * "Content:list",
     * "Content:details"
     * })
     */
    private $path;

    /**
     * @ORM\Column
     *
     * @Gedmo\UploadableFileName
     */
    private $name;

    /**
     * @ORM\Column
     *
     * @Gedmo\UploadableFileMimeType
     */
    private $mimeType;

    /**
     * @ORM\Column(type="decimal")
     *
     * @Gedmo\UploadableFileSize
     */
    private $size;

    /**
     * @Assert\File()
     */
    private $file;
    
    /**
     * @var string
     *
     * @ORM\Column(name="altText", type="string", length=255, nullable=true)
     */
    private $altText;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     */
    private $author;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $public;

    /**
     * Set file.
     *
     * @param File $file
     *
     * @return Media
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file.
     *
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    public function __construct()
    {
        $this->public = false;
    }

    /**
     * to string method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }

    /**
     * Get path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
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
     * Get mimeType.
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Get size.
     *
     * @return Double
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set altText.
     *
     * @param string $altText
     *
     * @return Media
     */
    public function setAltText($altText)
    {
        $this->altText = $altText;

        return $this;
    }

    /**
     * Get altText.
     *
     * @return string
     */
    public function getAltText()
    {
        return $this->altText;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Media
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
     * Set authorId.
     *
     * @param int $authorId
     *
     * @return Media
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get authorId.
     *
     * @return int
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Set author.
     *
     * @param Media $author
     *
     * @return User
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return Media
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set public.
     *
     * @param bool $public
     *
     * @return Media
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }
    
    /**
     * Get public.
     *
     * @return bool
     */
    public function getPublic()
    {
        return $this->public;
    }
}
