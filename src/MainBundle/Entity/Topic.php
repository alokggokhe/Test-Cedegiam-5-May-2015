<?php

namespace MainBundle\Entity;


use MainBundle\Traits\PrimaryIdTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="topic")
 * @ORM\Entity(repositoryClass="MainBundle\Entity\TopicRepository")
 */
class Topic
{

    use PrimaryIdTrait;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    protected $name;


    /**
     * @ORM\ManyToMany(targetEntity="Invitation", mappedBy="topics")
     **/
    protected $invitations;

    /**
     * @ORM\ManyToMany(targetEntity="Msl", mappedBy="topics")
     */
    protected $msls;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invitations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->msls = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Topic
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
     * Add invitations
     *
     * @param \MainBundle\Entity\Invitation $invitations
     * @return Topic
     */
    public function addInvitation(\MainBundle\Entity\Invitation $invitations)
    {
        $this->invitations[] = $invitations;

        return $this;
    }

    /**
     * Remove invitations
     *
     * @param \MainBundle\Entity\Invitation $invitations
     */
    public function removeInvitation(\MainBundle\Entity\Invitation $invitations)
    {
        $this->invitations->removeElement($invitations);
    }

    /**
     * Get invitations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvitations()
    {
        return $this->invitations;
    }

    /**
     * Add msls
     *
     * @param \MainBundle\Entity\Msl $msls
     * @return Topic
     */
    public function addMsl(\MainBundle\Entity\Msl $msls)
    {
        $this->msls[] = $msls;

        return $this;
    }

    /**
     * Remove msls
     *
     * @param \MainBundle\Entity\Msl $msls
     */
    public function removeMsl(\MainBundle\Entity\Msl $msls)
    {
        $this->msls->removeElement($msls);
    }

    /**
     * Get msls
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMsls()
    {
        return $this->msls;
    }
    public function __toString()
    {
        return $this->name;
    }

}
