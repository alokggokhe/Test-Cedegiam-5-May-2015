<?php

namespace MainBundle\Services\Mailer;


use Doctrine\ORM\EntityManager;
use MainBundle\Entity\Invitation;

class HcpMailer
{


    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    protected $templating;

    protected $mailer;

    protected $relatedAE_email;

    public function __construct(EntityManager $em, $templating, $mailer, $relatedAE_email)
    {
        $this->em = $em;
        $this->templating = $templating;
        $this->mailer = $mailer;

        $this->relatedAE_email = $relatedAE_email;

    }

    /**
     * @param Invitation $invitation MainBundle/Entity/Invitation
     * @return \Doctrine\Common\Collections\Collection
     */
    public function  sendMail(Invitation $invitation)
    {

        $message = \Swift_Message::newInstance()
            ->setSubject('Your request for UCB Medical Specialist remote presentation appointment')
            ->setFrom('no-reply@dandelion.com')
            ->setTo($invitation->getEmail())
            ->setBody($this->templating->render('MainBundle:Mail:hcp.html.twig', array(
                'name' => $invitation->getName(),
                'question' => $invitation->getQuestion(),
                'date' => $invitation->getDateTime()->format('Y/m/d'),
                'time' => $invitation->getDateTime()->format('H:i A'),

            )), 'text/html');

        if($invitation->getRelatedToAE() && !empty($this->relatedAE_email)){
            $message->setBcc($this->relatedAE_email);
        }

        //$this->mailer->send($message);

        return true;
    }
}