<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AdminBundle\Entity\UserRepository")
 */
class User implements AdvancedUserInterface
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="firstName", type="string", length=32, nullable=false)
	 */
	private $firstname;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="lastName", type="string", length=32, nullable=false)
	 */
	private $lastname;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=32, nullable=false)
	 */
	private $email;

	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(name="username", type="string", length=32, unique=true)
	 */
	private $username;

	/**
	 * @var string
	 *
	 * @Assert\NotBlank()
	 * @ORM\Column(name="password", type="string", length=255, nullable=false)
	 */
	private $password;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="expirationDate", type="date", nullable=false)
	 */
	private $expirationdate;



	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set firstname
	 *
	 * @param string $firstname
	 *
	 * @return User
	 */
	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;

		return $this;
	}

	/**
	 * Get firstname
	 *
	 * @return string
	 */
	public function getFirstname()
	{
		return $this->firstname;
	}

	/**
	 * Set lastname
	 *
	 * @param string $lastname
	 *
	 * @return User
	 */
	public function setLastname($lastname)
	{
		$this->lastname = $lastname;

		return $this;
	}

	/**
	 * Get lastname
	 *
	 * @return string
	 */
	public function getLastname()
	{
		return $this->lastname;
	}

	/**
	 * Set email
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
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set username
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
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Set password
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
	 * Get password
	 *
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set expirationdate
	 *
	 * @param \DateTime $expirationdate
	 *
	 * @return User
	 */
	public function setExpirationdate($expirationdate)
	{
		$this->expirationdate = $expirationdate;

		return $this;
	}

	/**
	 * Get expirationdate
	 *
	 * @return \DateTime
	 */
	public function getExpirationdate()
	{
		return $this->expirationdate;
	}

	public function getSalt()
	{
		// you *may* need a real salt depending on your encoder
		// see section on salt below
		return null;
	}

	public function getRoles()
	{
		return array('ROLE_ADMIN');
	}

	public function eraseCredentials()
	{

	}

	/** @see \Serializable::serialize() */
	public function serialize()
	{
		return serialize(array(
			$this->id,
			$this->username,
			$this->password,
			// see section on salt below
			// $this->salt,
		));
	}

	/** @see \Serializable::unserialize() */
	public function unserialize($serialized)
	{
		list (
			$this->id,
			$this->username,
			$this->password,
			// see section on salt below
			// $this->salt
		) = unserialize($serialized);
	}

	public function isAccountNonExpired()
    {
    	if('' != $this->expirationdate && $this->expirationdate->format('Y-m-d') <= date('Y-m-d')) {
    		return false;
    	}

        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return true;
    }
}
