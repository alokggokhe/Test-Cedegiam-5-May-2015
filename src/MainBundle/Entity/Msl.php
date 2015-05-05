<?php

namespace MainBundle\Entity;


use MainBundle\Traits\PrimaryIdTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Msl
 *
 * @ORm\Table(name="msl")
 * @ORM\Entity(repositoryClass="MainBundle\Entity\MslRepository")
 */
class Msl
{

    use PrimaryIdTrait;


    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=6, nullable=false)
     */
    protected $gender;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=8, nullable=false)
     */
    protected $role;

    /**
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    protected $mslTerritory;

    /**
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    protected $therapeuticArea;

    /**
     * @ORM\ManyToMany(targetEntity="Topic", inversedBy="topics")
     * @ORM\JoinTable(name="topics_msls")
     **/
    protected $topics;

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Msl
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Msl
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Msl
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Msl
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
     * Set role
     *
     * @param string $role
     * @return Msl
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set mslTerritory
     *
     * @param string $mslTerritory
     * @return Msl
     */
    public function setMslTerritory($mslTerritory)
    {
        $this->mslTerritory = $mslTerritory;

        return $this;
    }

    /**
     * Get mslTerritory
     *
     * @return string 
     */
    public function getMslTerritory()
    {
        return $this->mslTerritory;
    }

    /**
     * Set therapeuticArea
     *
     * @param string $therapeuticArea
     * @return Msl
     */
    public function setTherapeuticArea($therapeuticArea)
    {
        $this->therapeuticArea = $therapeuticArea;

        return $this;
    }

    /**
     * Get therapeuticArea
     *
     * @return string 
     */
    public function getTherapeuticArea()
    {
        return $this->therapeuticArea;
    }

    /**
     * Set topic
     *
     * @param \MainBundle\Entity\Topic $topic
     * @return Invitation
     */
    public function setTopic(\MainBundle\Entity\Topic $topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Add topics
     *
     * @param \MainBundle\Entity\Topic $topics
     * @return Invitation
     */
    public function addTopic(\MainBundle\Entity\Topic $topics)
    {
        $this->topics[] = $topics;

        return $this;
    }

    /**
     * Remove topics
     *
     * @param \MainBundle\Entity\Topic $topics
     */
    public function removeTopic(\MainBundle\Entity\Topic $topics)
    {
        $this->topics->removeElement($topics);
    }

    /**
     * Get topics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTopics()
    {
        return $this->topics;
    }

}
