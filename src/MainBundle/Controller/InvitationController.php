<?php

namespace MainBundle\Controller;


use MainBundle\Entity\Invitation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use Cegedim\Bundle\OwaCasBundle\Security\User\OwaUser;

class InvitationController extends Controller
{
    public function indexAction(Request $request)
    {
        $invitation = new Invitation();
        $form = $this->createForm('invitation', $invitation);

        $user = null;

        if($this->get('security.context')->getToken()->getUser() instanceof OwaUser){
            $user = $this->get('security.context')->getToken()->getUser();
        }


        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invitation);
            $em->flush();

            // $mslMailerService = $this->get('msl_mailer');
            // $sentMsl = $mslMailerService->sendMail($invitation);

            // $hcpMailerService = $this->get('hcp_mailer');
            // $sentHcp = $hcpMailerService->sendMail($invitation);

            // if (true !== $sentMsl || true !== $sentHcp ){
            //     throw new \Exception('Send mail exception');
            // }



            return $this->redirect($this->generateUrl('confirm', array('name'=>$invitation->getName())));
        }
        return $this->render('MainBundle:Invitation:invitation.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
        ));
    }
}