<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActivityRepository")
 */
class Activity
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
     * @ORM\Column(name="aidName", type="string", length=255)
     */
    private $aidName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="degreeType", type="string", length=255, nullable=true)
     */
    private $degreeType;

    /**
     * @var string
     *
     * @ORM\Column(name="trainingName", type="string", length=255, nullable=true)
     */
    private $trainingName;

    /**
     * @var string
     *
     * @ORM\Column(name="degreeOption", type="string", length=255, nullable=true)
     */
    private $degreeOption;

    /**
     * @var string
     *
     * @ORM\Column(name="degree", type="string", length=255, nullable=true)
     */
    private $degree;

    /**
     * @var string
     *
     * @ORM\Column(name="trainingMode", type="string", length=255, nullable=true)
     */
    private $trainingMode;

    /**
     * @var string
     *
     * @ORM\Column(name="recruitMode", type="string", length=255, nullable=true)
     */
    private $recruitMode;

    /**
     * @var string
     *
     * @ORM\Column(name="benefitType", type="string", length=255, nullable=true)
     */
    private $benefitType;

    /**
     * @var string
     *
     * @ORM\Column(name="lessonLevel", type="string", length=255, nullable=true)
     */
    private $lessonLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="audienceType", type="string", length=255, nullable=true)
     */
    private $audienceType;

    /**
     * @var string
     *
     * @ORM\Column(name="specificAudience", type="string", length=255, nullable=true)
     */
    private $specificAudience;

    /**
     * @var string
     *
     * @ORM\Column(name="conditions", type="string", length=255, nullable=true)
     */
    private $conditions;

    /**
     * @var string
     *
     * @ORM\Column(name="serviceMission", type="string", length=255, nullable=true)
     */
    private $serviceMission;

    /**
     * @var string
     *
     * @ORM\Column(name="publicInfo", type="string", length=255, nullable=true)
     */
    private $publicInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="recMode", type="string", length=255, nullable=true)
     */
    private $recMode;

    /**
     * @var string
     *
     * @ORM\Column(name="destinations", type="string", length=255, nullable=true)
     */
    private $destinations;

    /**
     * @var string
     *
     * @ORM\Column(name="period", type="string", length=255, nullable=true)
     */
    private $period;

    /**
     * @var string
     *
     * @ORM\Column(name="cost", type="string", length=255, nullable=true)
     */
    private $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="salary", type="string", length=255, nullable=true)
     */
    private $salary;

    /**
     * @var string
     *
     * @ORM\Column(name="serviceName", type="string", length=255, nullable=true)
     */
    private $serviceName;

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
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="tax", type="string", length=255, nullable=true)
     */
    private $tax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="aidNature", type="string", length=255, nullable=true)
     */
    private $aidNature;

    /**
     * @var string
     *
     * @ORM\Column(name="regLocation", type="string", length=255, nullable=true)
     */
    private $regLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255, nullable=true)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="trainingDomain", type="string", length=255, nullable=true)
     */
    private $trainingDomain;

    /**
     * @var string
     *
     * @ORM\Column(name="partnership", type="string", length=255, nullable=true)
     */
    private $partnership;

    /**
     * @var string
     *
     * @ORM\Column(name="activityDomain", type="string", length=255, nullable=true)
     */
    private $activityDomain;


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
     * Set aidName.
     *
     * @param string $aidName
     *
     * @return Activity
     */
    public function setAidName($aidName)
    {
        $this->aidName = $aidName;

        return $this;
    }

    /**
     * Get aidName.
     *
     * @return string
     */
    public function getAidName()
    {
        return $this->aidName;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Activity
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
     * Set degreeType.
     *
     * @param string $degreeType
     *
     * @return Activity
     */
    public function setDegreeType($degreeType)
    {
        $this->degreeType = $degreeType;

        return $this;
    }

    /**
     * Get degreeType.
     *
     * @return string
     */
    public function getDegreeType()
    {
        return $this->degreeType;
    }

    /**
     * Set trainingName.
     *
     * @param string $trainingName
     *
     * @return Activity
     */
    public function setTrainingName($trainingName)
    {
        $this->trainingName = $trainingName;

        return $this;
    }

    /**
     * Get trainingName.
     *
     * @return string
     */
    public function getTrainingName()
    {
        return $this->trainingName;
    }

    /**
     * Set degreeOption.
     *
     * @param string $degreeOption
     *
     * @return Activity
     */
    public function setDegreeOption($degreeOption)
    {
        $this->degreeOption = $degreeOption;

        return $this;
    }

    /**
     * Get degreeOption.
     *
     * @return string
     */
    public function getDegreeOption()
    {
        return $this->degreeOption;
    }

    /**
     * Set degree.
     *
     * @param string $degree
     *
     * @return Activity
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * Get degree.
     *
     * @return string
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * Set trainingMode.
     *
     * @param string $trainingMode
     *
     * @return Activity
     */
    public function setTrainingMode($trainingMode)
    {
        $this->trainingMode = $trainingMode;

        return $this;
    }

    /**
     * Get trainingMode.
     *
     * @return string
     */
    public function getTrainingMode()
    {
        return $this->trainingMode;
    }

    /**
     * Set recruitMode.
     *
     * @param string $recruitMode
     *
     * @return Activity
     */
    public function setRecruitMode($recruitMode)
    {
        $this->recruitMode = $recruitMode;

        return $this;
    }

    /**
     * Get recruitMode.
     *
     * @return string
     */
    public function getRecruitMode()
    {
        return $this->recruitMode;
    }

    /**
     * Set benefitType.
     *
     * @param string $benefitType
     *
     * @return Activity
     */
    public function setBenefitType($benefitType)
    {
        $this->benefitType = $benefitType;

        return $this;
    }

    /**
     * Get benefitType.
     *
     * @return string
     */
    public function getBenefitType()
    {
        return $this->benefitType;
    }

    /**
     * Set lessonLevel.
     *
     * @param string $lessonLevel
     *
     * @return Activity
     */
    public function setLessonLevel($lessonLevel)
    {
        $this->lessonLevel = $lessonLevel;

        return $this;
    }

    /**
     * Get lessonLevel.
     *
     * @return string
     */
    public function getLessonLevel()
    {
        return $this->lessonLevel;
    }

    /**
     * Set audienceType.
     *
     * @param string $audienceType
     *
     * @return Activity
     */
    public function setAudienceType($audienceType)
    {
        $this->audienceType = $audienceType;

        return $this;
    }

    /**
     * Get audienceType.
     *
     * @return string
     */
    public function getAudienceType()
    {
        return $this->audienceType;
    }

    /**
     * Set specificAudience.
     *
     * @param string $specificAudience
     *
     * @return Activity
     */
    public function setSpecificAudience($specificAudience)
    {
        $this->specificAudience = $specificAudience;

        return $this;
    }

    /**
     * Get specificAudience.
     *
     * @return string
     */
    public function getSpecificAudience()
    {
        return $this->specificAudience;
    }

    /**
     * Set conditions.
     *
     * @param string $conditions
     *
     * @return Activity
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions.
     *
     * @return string
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set serviceMission.
     *
     * @param string $serviceMission
     *
     * @return Activity
     */
    public function setServiceMission($serviceMission)
    {
        $this->serviceMission = $serviceMission;

        return $this;
    }

    /**
     * Get serviceMission.
     *
     * @return string
     */
    public function getServiceMission()
    {
        return $this->serviceMission;
    }

    /**
     * Set publicInfo.
     *
     * @param string $publicInfo
     *
     * @return Activity
     */
    public function setPublicInfo($publicInfo)
    {
        $this->publicInfo = $publicInfo;

        return $this;
    }

    /**
     * Get publicInfo.
     *
     * @return string
     */
    public function getPublicInfo()
    {
        return $this->publicInfo;
    }

    /**
     * Set recMode.
     *
     * @param string $recMode
     *
     * @return Activity
     */
    public function setRecMode($recMode)
    {
        $this->recMode = $recMode;

        return $this;
    }

    /**
     * Get recMode.
     *
     * @return string
     */
    public function getRecMode()
    {
        return $this->recMode;
    }

    /**
     * Set destinations.
     *
     * @param string $destinations
     *
     * @return Activity
     */
    public function setDestinations($destinations)
    {
        $this->destinations = $destinations;

        return $this;
    }

    /**
     * Get destinations.
     *
     * @return string
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * Set period.
     *
     * @param string $period
     *
     * @return Activity
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period.
     *
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set cost.
     *
     * @param string $cost
     *
     * @return Activity
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost.
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set salary.
     *
     * @param string $salary
     *
     * @return Activity
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary.
     *
     * @return string
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set serviceName.
     *
     * @param string $serviceName
     *
     * @return Activity
     */
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;

        return $this;
    }

    /**
     * Get serviceName.
     *
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * Set address.
     *
     * @param string $address
     *
     * @return Activity
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
     * @return Activity
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
     * Set zipCode.
     *
     * @param string $zipCode
     *
     * @return Activity
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
     * @return Activity
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
     * Set phone.
     *
     * @param string $phone
     *
     * @return Activity
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
     * Set tax.
     *
     * @param string $tax
     *
     * @return Activity
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax.
     *
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Activity
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
     * Set aidNature.
     *
     * @param string $aidNature
     *
     * @return Activity
     */
    public function setAidNature($aidNature)
    {
        $this->aidNature = $aidNature;

        return $this;
    }

    /**
     * Get aidNature.
     *
     * @return string
     */
    public function getAidNature()
    {
        return $this->aidNature;
    }

    /**
     * Set regLocation.
     *
     * @param string $regLocation
     *
     * @return Activity
     */
    public function setRegLocation($regLocation)
    {
        $this->regLocation = $regLocation;

        return $this;
    }

    /**
     * Get regLocation.
     *
     * @return string
     */
    public function getRegLocation()
    {
        return $this->regLocation;
    }

    /**
     * Set comment.
     *
     * @param string $comment
     *
     * @return Activity
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set contact.
     *
     * @param string $contact
     *
     * @return Activity
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact.
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set trainingDomain.
     *
     * @param string $trainingDomain
     *
     * @return Activity
     */
    public function setTrainingDomain($trainingDomain)
    {
        $this->trainingDomain = $trainingDomain;

        return $this;
    }

    /**
     * Get trainingDomain.
     *
     * @return string
     */
    public function getTrainingDomain()
    {
        return $this->trainingDomain;
    }

    /**
     * Set partnership.
     *
     * @param string $partnership
     *
     * @return Activity
     */
    public function setPartnership($partnership)
    {
        $this->partnership = $partnership;

        return $this;
    }

    /**
     * Get partnership.
     *
     * @return string
     */
    public function getPartnership()
    {
        return $this->partnership;
    }

    /**
     * Set activityDomain.
     *
     * @param string $activityDomain
     *
     * @return Activity
     */
    public function setActivityDomain($activityDomain)
    {
        $this->activityDomain = $activityDomain;

        return $this;
    }

    /**
     * Get activityDomain.
     *
     * @return string
     */
    public function getActivityDomain()
    {
        return $this->activityDomain;
    }
}
