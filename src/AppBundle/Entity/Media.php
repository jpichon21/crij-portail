<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 *
 * @Gedmo\Uploadable(callback="myCallbackMethod", allowOverwrite=true, filenameGenerator="ALPHANUMERIC", appendNumber=true, allowedTypes="image/jpeg,image/pjpeg,image/png,image/x-png")
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
    public $file;

    /**
     * Set file.
     *
     * @param File $file
     *
     * @return Section
     */
    public function setFile($file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Set file.
     *
     * @param array $info
     *
     * Interfaced void
     */
    public function myCallbackMethod(array $info)
    {
    }

    /**
     * to string method
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
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
}
