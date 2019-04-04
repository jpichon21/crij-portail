<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Organism
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 *
 * @ORM\Table(name="organism")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganismRepository")
 */
class Organism
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="initials", type="string", length=255, nullable=true)
     */
    private $initials;

    /**
     * @var string
     *
     * @ORM\Column(name="name2", type="string", length=255, nullable=true)
     */
    private $name2;

    /**
     * @var string
     *
     * @ORM\Column(name="instGroup", type="string", length=255, nullable=true)
     */
    private $instGroup;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=255, nullable=true)
     */
    private $address2;

    /**
     * @var string
     *
     * @ORM\Column(name="postalBox", type="string", length=255, nullable=true)
     */
    private $postalBox;

    /**
     * @var string
     *
     * @ORM\Column(name="poBox", type="string", length=255, nullable=true)
     */
    private $poBox;

    /**
     * @var string
     *
     * @ORM\Column(name="zipCode", type="string", length=255, nullable=true)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="OFZipCode", type="string", length=255, nullable=true)
     */
    private $oFZipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="OFCity", type="string", length=255, nullable=true)
     */
    private $oFCity;

    /**
     * @var string
     *
     * @ORM\Column(name="cedex", type="string", length=255, nullable=true)
     */
    private $cedex;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="phone2", type="string", length=255, nullable=true)
     */
    private $phone2;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var int
     *
     * @ORM\Column(name="department", type="integer", nullable=true)
     */
    private $department;

    /**
     * @var int
     *
     * @ORM\Column(name="academy", type="integer", nullable=true)
     */
    private $academy;

    /**
     * @var int
     *
     * @ORM\Column(name="region", type="integer", nullable=true)
     */
    private $region;

    /**
     * @var int
     *
     * @ORM\Column(name="country", type="integer", nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="recAddress", type="string", length=255, nullable=true)
     */
    private $recAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="openHours", type="string", length=255, nullable=true)
     */
    private $openHours;

    /**
     * @var string
     *
     * @ORM\Column(name="missions", type="string", length=255, nullable=true)
     */
    private $missions;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="netName", type="integer", nullable=true)
     */
    private $netName;

    /**
     * @var string
     *
     * @ORM\Column(name="netDescription", type="string", length=255, nullable=true)
     */
    private $netDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="agreement", type="string", length=255, nullable=true)
     */
    private $agreement;

    /**
     * @var int
     *
     * @ORM\Column(name="skills", type="integer", nullable=true)
     */
    private $skills;

    /**
     * @var string
     *
     * @ORM\Column(name="zone", type="string", length=255, nullable=true)
     */
    private $zone;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @var \DateTime
     *
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
        return $this->getName();
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
     * Set name.
     *
     * @param string $name
     *
     * @return Organism
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set initials.
     *
     * @param string $initials
     *
     * @return Organism
     */
    public function setInitials($initials)
    {
        $this->initials = $initials;

        return $this;
    }

    /**
     * Get initials.
     *
     * @return string
     */
    public function getInitials()
    {
        return $this->initials;
    }

    /**
     * Set name2.
     *
     * @param string $name2
     *
     * @return Organism
     */
    public function setName2($name2)
    {
        $this->name2 = $name2;

        return $this;
    }

    /**
     * Get name2.
     *
     * @return string
     */
    public function getName2()
    {
        return $this->name2;
    }

    /**
     * Set address.
     *
     * @param string $address
     *
     * @return Organism
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address2.
     *
     * @param string $address2
     *
     * @return Organism
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2.
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set postalBox.
     *
     * @param string $postalBox
     *
     * @return Organism
     */
    public function setPostalBox($postalBox)
    {
        $this->postalBox = $postalBox;

        return $this;
    }

    /**
     * Get postalBox.
     *
     * @return string
     */
    public function getPostalBox()
    {
        return $this->postalBox;
    }

    /**
     * Set poBox.
     *
     * @param string $poBox
     *
     * @return Organism
     */
    public function setPoBox($poBox)
    {
        $this->poBox = $poBox;

        return $this;
    }

    /**
     * Get poBox.
     *
     * @return string
     */
    public function getPoBox()
    {
        return $this->poBox;
    }

    /**
     * Set zipCode.
     *
     * @param string $zipCode
     *
     * @return Organism
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode.
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set city.
     *
     * @param string $city
     *
     * @return Organism
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set oFZipCode.
     *
     * @param string $oFZipCode
     *
     * @return Organism
     */
    public function setOFZipCode($oFZipCode)
    {
        $this->oFZipCode = $oFZipCode;

        return $this;
    }

    /**
     * Get oFZipCode.
     *
     * @return string
     */
    public function getOFZipCode()
    {
        return $this->oFZipCode;
    }

    /**
     * Set oFCity.
     *
     * @param string $oFCity
     *
     * @return Organism
     */
    public function setOFCity($oFCity)
    {
        $this->oFCity = $oFCity;

        return $this;
    }

    /**
     * Get oFCity.
     *
     * @return string
     */
    public function getOFCity()
    {
        return $this->oFCity;
    }

    /**
     * Set cedex.
     *
     * @param string $cedex
     *
     * @return Organism
     */
    public function setCedex($cedex)
    {
        $this->cedex = $cedex;

        return $this;
    }

    /**
     * Get cedex.
     *
     * @return string
     */
    public function getCedex()
    {
        return $this->cedex;
    }

    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return Organism
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone2.
     *
     * @param string $phone2
     *
     * @return Organism
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;

        return $this;
    }

    /**
     * Get phone2.
     *
     * @return string
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * Set fax.
     *
     * @param string $fax
     *
     * @return Organism
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax.
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Organism
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return Organism
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set department.
     *
     * @param int $department
     *
     * @return Organism
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department.
     *
     * @return int
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set academy.
     *
     * @param int $academy
     *
     * @return Organism
     */
    public function setAcademy($academy)
    {
        $this->academy = $academy;

        return $this;
    }

    /**
     * Get academy.
     *
     * @return int
     */
    public function getAcademy()
    {
        return $this->academy;
    }

    /**
     * Set region.
     *
     * @param int $region
     *
     * @return Organism
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region.
     *
     * @return int
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set country.
     *
     * @param int $country
     *
     * @return Organism
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return int
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set recAddress.
     *
     * @param string $recAddress
     *
     * @return Organism
     */
    public function setRecAddress($recAddress)
    {
        $this->recAddress = $recAddress;

        return $this;
    }

    /**
     * Get recAddress.
     *
     * @return string
     */
    public function getRecAddress()
    {
        return $this->recAddress;
    }

    /**
     * Set openHours.
     *
     * @param string $openHours
     *
     * @return Organism
     */
    public function setOpenHours($openHours)
    {
        $this->openHours = $openHours;

        return $this;
    }

    /**
     * Get openHours.
     *
     * @return string
     */
    public function getOpenHours()
    {
        return $this->openHours;
    }

    /**
     * Set missions.
     *
     * @param string $missions
     *
     * @return Organism
     */
    public function setMissions($missions)
    {
        $this->missions = $missions;

        return $this;
    }

    /**
     * Get missions.
     *
     * @return string
     */
    public function getMissions()
    {
        return $this->missions;
    }

    /**
     * Set type.
     *
     * @param int $type
     *
     * @return Organism
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set instGroup.
     *
     * @param string $instGroup
     *
     * @return Organism
     */
    public function setInstGroup($instGroup)
    {
        $this->instGroup = $instGroup;

        return $this;
    }

    /**
     * Get instGroup.
     *
     * @return string
     */
    public function getInstGroup()
    {
        return $this->instGroup;
    }

    /**
     * Set netName.
     *
     * @param int $netName
     *
     * @return Organism
     */
    public function setNetName($netName)
    {
        $this->netName = $netName;

        return $this;
    }

    /**
     * Get netName.
     *
     * @return int
     */
    public function getNetName()
    {
        return $this->netName;
    }

    /**
     * Set netDescription.
     *
     * @param string $netDescription
     *
     * @return Organism
     */
    public function setNetDescription($netDescription)
    {
        $this->netDescription = $netDescription;

        return $this;
    }

    /**
     * Get netDescription.
     *
     * @return string
     */
    public function getNetDescription()
    {
        return $this->netDescription;
    }

    /**
     * Set agreement.
     *
     * @param string $agreement
     *
     * @return Organism
     */
    public function setAgreement($agreement)
    {
        $this->agreement = $agreement;

        return $this;
    }

    /**
     * Get agreement.
     *
     * @return string
     */
    public function getAgreement()
    {
        return $this->agreement;
    }

    /**
     * Set skills.
     *
     * @param int $skills
     *
     * @return Organism
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * Get skills.
     *
     * @return int
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set zone.
     *
     * @param string $zone
     *
     * @return Organism
     */
    public function setZone($zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone.
     *
     * @return string
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Organism
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set note.
     *
     * @param string $note
     *
     * @return Organism
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note.
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set longitude.
     *
     * @param string $longitude
     *
     * @return Organism
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude.
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude.
     *
     * @param string $latitude
     *
     * @return Organism
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude.
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set deletedAt.
     *
     * @param \DateTime|null $deletedAt
     *
     * @return Organism
     */
    public function setDeletedAt($deletedAt = null)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt.
     *
     * @return \DateTime|null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}
