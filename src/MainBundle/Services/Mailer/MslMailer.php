<?php

namespace MainBundle\Services\Mailer;


use Doctrine\ORM\EntityManager;
use MainBundle\Entity\Invitation;

class MslMailer
{


    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    protected $templating;

    protected $mailer;

    public function __construct(EntityManager $em, $templating, $mailer) {
        $this->em = $em;
        $this->templating = $templating;
        $this->mailer = $mailer;

    }

    /**
     * @param Invitation $invitation MainBundle/Entity/Invitation
     * @return \Doctrine\Common\Collections\Collection
     */
    public function  sendMail(Invitation $invitation)
    {
        /**
         * MainBundle/Entity/Topic
         */
        $topics = $invitation->getTopics();

        $emailsAdressList = [];
        foreach($topics as $topic){
            $emails = $this->em->getRepository('MainBundle\Entity\Invitation')->getMslMailForInvitation($topic->getId());
            foreach($emails as $email){
                array_push($emailsAdressList, $email['email']);
            }
        }

        $emailsAdressList = array_unique($emailsAdressList);
      
      
        $message = \Swift_Message::newInstance()
            ->setSubject('HCP request for Immediate Callback')
            ->setFrom($invitation->getEmail())
            ->setTo($emailsAdressList)
            ->setBody($this->templating->render('MainBundle:Mail:msl.html.twig', array(
                'name' => $invitation->getName(),
                'topics' =>$invitation->getTopics(),
                'phone' =>$invitation->getPhone(),
                'availability' =>$invitation->getAvailabilityDetails(),
                'question'=>$invitation->getQuestion(),
                'dateTime'=>$invitation->getDateTime()
            )),'text/html');
        //$this->mailer->send($message);

        return true;
    }
} 