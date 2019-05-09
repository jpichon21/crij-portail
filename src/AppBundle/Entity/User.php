<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("all")
 */
class User implements UserInterface
{
    const ROLES = [
        'Utilisateur' => 'ROLE_USER',
        'Éditeur' => 'ROLE_EDITOR',
        'Administrateur' => 'ROLE_ADMIN',
        'Super Administrateur' => 'ROLE_SUPER_ADMIN',
    ];

    const STATUT = [
        'Collégien' => 'schoolboy',
        'Lycéen' => 'high_school_student',
        'Etudiant' => 'student',
        'Demandeur d\'emploi' => 'jobseeker',
        'En emploi' => 'employed',
        'Apprenti' => 'apprentice',
        'En formation' => 'training',
        'Autre' => 'other',
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string", unique=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @Assert\NotNull
     */
    private $email;
    

    /**
     * @ORM\Column(name="password", type="string", nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(name="roles", type="json_array")
     */
    private $roles;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var bool
     * @ORM\Column(name="consentName", type="boolean")
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\Type("boolean")
     */
    private $consentName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\NotBlank
     */
    private $lastName;

    /**
     * @var bool
     * @ORM\Column(name="consentLastName", type="boolean")
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\Type("boolean")
     */
    private $consentLastName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime")
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\NotBlank
     */
    private $gender;
    
    /**
     * @var string
     *
     * @ORM\Column(name="age", type="integer", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\NotBlank
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     */
    private $status;

    /**
     * @var bool
     * @ORM\Column(name="consentMail", type="boolean")
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\Type("boolean")
     */
    private $consentMail;
    
    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\NotBlank
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\NotBlank
     */
    private $zipcode;
    
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\NotBlank
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="department", type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\NotBlank
     */
    private $department;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     */
    private $phone;

    /**
     * @var bool
     * @ORM\Column(name="usePhone", type="boolean")
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\Type("boolean")
     */
    private $usePhone;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     */
    private $mobile;

    /**
     * @var bool
     * @ORM\Column(name="useMobile", type="boolean")
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\Type("boolean")
     */
    private $useMobile;

    /**
     * @var bool
     * @ORM\Column(name="consentTerms", type="boolean")
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\IsTrue
     */
    private $consentTerms;

    /**
     * @var bool
     * @ORM\Column(name="consentNews", type="boolean")
     * @Serializer\Expose()
     * @Serializer\Groups({"User:details"})
     * @Assert\NotNull
     * @Assert\Type("boolean")
     */
    private $consentNews;

    /**
     * @var string
     * @Serializer\Expose()
     * @Serializer\Type("string")
     */
    private $plainPassword;


    /**
     * to string method
     *
     * @return string
    */
    public function __toString()
    {
        return $this->getName().' '.$this->getLastName();
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
     * Set id.
     *
     * @param bool $id
     *
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return User
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
     * Set password.
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set roles.
     *
     * @param json $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = [];
        foreach ($roles as $role) {
            $this->addRole($role);
        }
        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get password.
     *
     * @return Array
     */
    public function getRoles()
    {
        return $this->roles;
    }
    
    /**
     * void
     */
    public function getSalt()
    {
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * void
     */
    public function eraseCredentials()
    {
    }

    /**
     * Add role.
     *
     * @param string $role
     * @return User
     */
    public function addRole($role)
    {
        if (!$role) {
            return $this;
        }
        $role = strtoupper($role);
        $this->roles[] = $role;
        return $this;
    }
    
    /**
     * Remove role.
     *
     * @param string $role
     * @return User
     */
    public function removeRole($role)
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }
        return $this;
    }
    
    /**
     * Remove role.
     *
     * @param string $role
     * @return Boolean
     */
    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->roles, true);
    }

    /**
     * Return if user is allowedToPublish.
     *
     * @param string $role
     * @return Boolean
     */
    public function allowedToPublish()
    {
        if (in_array('ROLE_ADMIN', $this->getRoles()) || in_array('ROLE_SUPER_ADMIN', $this->getRoles())) {
            return true;
        }
        return false;
    }

    /**
     * Set plainPassword.
     *
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

        /**
     * Get plainPassword.
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return User
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
     * Set consentName.
     *
     * @param bool $consentName
     *
     * @return User
     */
    public function setConsentName($consentName)
    {
        $this->consentName = $consentName;

        return $this;
    }

    /**
     * Get consentName.
     *
     * @return bool
     */
    public function getConsentName()
    {
        return $this->consentName;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set consentLastName.
     *
     * @param bool $consentLastName
     *
     * @return User
     */
    public function setConsentLastName($consentLastName)
    {
        $this->consentLastName = $consentLastName;

        return $this;
    }

    /**
     * Get consentLastName.
     *
     * @return bool
     */
    public function getConsentLastName()
    {
        return $this->consentLastName;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set birthdate.
     *
     * @param \DateTime $birthdate
     *
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate.
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set gender.
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender.
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set age.
     *
     * @param int $age
     *
     * @return User
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age.
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set consentMail.
     *
     * @param bool $consentMail
     *
     * @return User
     */
    public function setConsentMail($consentMail)
    {
        $this->consentMail = $consentMail;

        return $this;
    }

    /**
     * Get consentMail.
     *
     * @return bool
     */
    public function getConsentMail()
    {
        return $this->consentMail;
    }

    /**
     * Set address.
     *
     * @param string $address
     *
     * @return User
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
     * Set zipcode.
     *
     * @param string $zipcode
     *
     * @return User
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode.
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city.
     *
     * @param string $city
     *
     * @return User
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
     * Set department.
     *
     * @param string $department
     *
     * @return User
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department.
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return User
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
     * Set usePhone.
     *
     * @param bool $usePhone
     *
     * @return User
     */
    public function setUsePhone($usePhone)
    {
        $this->usePhone = $usePhone;

        return $this;
    }

    /**
     * Get usePhone.
     *
     * @return bool
     */
    public function getUsePhone()
    {
        return $this->usePhone;
    }

    /**
     * Set mobile.
     *
     * @param string $mobile
     *
     * @return User
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile.
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set useMobile.
     *
     * @param bool $useMobile
     *
     * @return User
     */
    public function setUseMobile($useMobile)
    {
        $this->useMobile = $useMobile;

        return $this;
    }

    /**
     * Get useMobile.
     *
     * @return bool
     */
    public function getUseMobile()
    {
        return $this->useMobile;
    }

    /**
     * Set consentTerms.
     *
     * @param bool $consentTerms
     *
     * @return User
     */
    public function setConsentTerms($consentTerms)
    {
        $this->consentTerms = $consentTerms;

        return $this;
    }

    /**
     * Get consentTerms.
     *
     * @return bool
     */
    public function getConsentTerms()
    {
        return $this->consentTerms;
    }

    /**
     * Set consentNews.
     *
     * @param bool $consentNews
     *
     * @return User
     */
    public function setConsentNews($consentNews)
    {
        $this->consentNews = $consentNews;

        return $this;
    }

    /**
     * Get consentNews.
     *
     * @return bool
     */
    public function getConsentNews()
    {
        return $this->consentNews;
    }
}
