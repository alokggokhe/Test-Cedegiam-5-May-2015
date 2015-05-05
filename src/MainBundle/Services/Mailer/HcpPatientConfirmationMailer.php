<?php

namespace MainBundle\Services\Mailer;


use Doctrine\ORM\EntityManager;
use MainBundle\Entity\Schedule;
use Cegedim\Bundle\OwaCasBundle\Security\User\OwaUser;

class HcpPatientConfirmationMailer
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
    public function sendMail(Schedule $schedule, OwaUser $owauser, $ucb_patient_action)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('UpComing Patient Education Session - '. $schedule->getTitle())
            // ->setFrom($owauser->getEmail())
            // ->setTo($schedule->getEmail())
            ->setFrom('alokggokhe@ymail.com')
            ->setTo('nirajm@alohatechnology.com')
            ->setBody($this->templating->render('MainBundle:Mail:hcp_patient_confirmation.html.twig', array(
                'firstname' => $schedule->getFirstname(),
                'lastname' => $schedule->getLastname(),
                'title' => $schedule->getTitle(),
                'idetailling_url' => $ucb_patient_action,
                'hcp_phone' => $owauser->getProfessionalPhone(),
                'hcp_firstname' => $owauser->getFirstname(),
                'hcp_name' => $owauser->getUsername(),
                'date' => $schedule->getScheduledatetime()->format('Y/m/d'),
                'time' => $schedule->getScheduledatetime()->format('h:i A'),
            )),'text/html');

        //$this->mailer->send($message);

        return true;
    }
}