<?php

namespace MainBundle\Entity;


use MainBundle\Traits\PrimaryIdTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Count;

/**
 * Invitation
 *
 * @ORM\Table(name="invitation")
 * @ORM\Entity(repositoryClass="MainBundle\Entity\InvitationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Invitation
{
    use PrimaryIdTrait;

     /**
     * @ORM\Column(type="boolean", nullable=false )
     */
    protected $relatedToAE = false;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    protected $availabilityDetails;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $dateTime;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=16, nullable=false)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $question;

    /**
     * @ORM\ManyToMany(targetEntity="Topic", inversedBy="topics")
     * @ORM\JoinTable(name="topics_invitations")
     * @Count(min = 1, minMessage = "At least one item must be selected")
     **/
    protected $topics;

    /**
     * Set relatedToAE
     *
     * @param bool $relatedToAE
     * @return Invitation
     */
    public function setRelatedToAE($relatedToAE)
    {
        $this->relatedToAE = $relatedToAE;

        return $this;
    }

    /**
     * Get realatedToAE
     *
     * @return boolean 
     */
    public function getRelatedToAE()
    {
        return $this->relatedToAE;
    }

    /**
     * Set availabilityDetails
     *
     * @param string $availabilityDetails
     * @return Invitation
     */
    public function setAvailabilityDetails($availabilityDetails)
    {
        $this->availabilityDetails = $availabilityDetails;

        return $this;
    }

    /**
     * Get availabilityDetails
     *
     * @return string 
     */
    public function getAvailabilityDetails()
    {
        return $this->availabilityDetails;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Invitation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Invitation
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
     * Set email
     *
     * @param string $email
     * @return Invitation
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
     * Set question
     *
     * @param string $question
     * @return Invitation
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
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
     * Constructor
     */
    public function __construct()
    {
        $this->topics = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * @param mixed $dateTime
     *
     * @return $this
     */
    public function setDateTime($dateTime)
    {
        if(true === is_string($dateTime))
        {
            $dateTime = new \DateTime($dateTime);
        }
        $this->dateTime = $dateTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }


    /**
     * Now we tell doctrine that before we persist or update we call the updatedTimestamps() function.
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updatedTimestamps()
    {
        if($this->getDateTime() == null)
        {
            $this->setDateTime(new \DateTime());
        }
    }

}
