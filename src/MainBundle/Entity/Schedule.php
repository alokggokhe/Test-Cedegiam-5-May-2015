<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 *
 * @ORM\Table(name="schedule")
 * @ORM\Entity
 */
class Schedule
{
    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="owaUuid", type="string", length=255, nullable=false)
     */
    private $owauuid;

    /**
     * @var string
     *
     * @ORM\Column(name="owaOnekeycode", type="string", length=255, nullable=false)
     */
    private $owaonekeycode;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=32, nullable=false)
     */
    private $title;

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
     * @ORM\Column(name="phone", type="string", length=16, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=10, nullable=false)
     */
    private $status = 'Pending';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="scheduleDateTime", type="datetime", nullable=false)
     */
    private $scheduledatetime;


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
     * Set owauuid
     *
     * @param string $owauuid
     *
     * @return Schedule
     */
    public function setOwauuid($owauuid)
    {
        $this->owauuid = $owauuid;

        return $this;
    }

    /**
     * Get owauuid
     *
     * @return string
     */
    public function getOwauuid()
    {
        return $this->owauuid;
    }

    /**
     * Set owaonekeycode
     *
     * @param string $owaonekeycode
     *
     * @return Schedule
     */
    public function setOwaonekeycode($owaonekeycode)
    {
        $this->owaonekeycode = $owaonekeycode;

        return $this;
    }

    /**
     * Get owaonekeycode
     *
     * @return string
     */
    public function getOwaonekeycode()
    {
        return $this->owaonekeycode;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Schedule
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Schedule
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
     * @return Schedule
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
     * @return Schedule
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
     * Set phone
     *
     * @param string $phone
     *
     * @return Schedule
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Schedule
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set scheduledatetime
     *
     * @param \DateTime $scheduledatetime
     *
     * @return Schedule
     */
    public function setScheduledatetime($scheduledatetime)
    {
        $this->scheduledatetime = $scheduledatetime;

        return $this;
    }

    /**
     * Get scheduledatetime
     *
     * @return \DateTime
     */
    public function getScheduledatetime()
    {
        return $this->scheduledatetime;
    }
}
