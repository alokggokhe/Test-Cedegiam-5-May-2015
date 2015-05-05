<?php

namespace MainBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Config\Definition\Exception\Exception;
use MainBundle\Entity\Schedule;
use Cegedim\Bundle\OwaCasBundle\Security\User\OwaUser;

class ScheduleController extends Controller
{
	public function addAction(Request $request)
	{
		$schedule = new Schedule();
		$form = $this->createForm('schedule', $schedule);

		$form->handleRequest($request);

		if ($form->isValid()) {
			$doctrine = $this->getDoctrine()->getManager();
			$doctrine->persist($schedule);
			$doctrine->flush();
			$this->sendMail($schedule->getId());
			return $this->redirect($this->generateUrl('schedule_confirm', array('id' => $schedule->getId())));
		}

		$ucb_patient_action = $this->container->getParameter('ucb_patient_login');
		return $this->render('MainBundle:Schedule:edit.html.twig', array(
			'form' => $form->createView(),
			'ucb_patient_action' => $ucb_patient_action
		));
	}

	public function editAction(Request $request, $id)
	{
		$doctrine = $this->getDoctrine()->getManager();       
		$schedule = $doctrine->getRepository('MainBundle:Schedule')->find($id);

		if (!$schedule) {
			return $this->redirect($this->generateUrl('option'));
		}

		$form = $this->createForm('schedule', $schedule, array(
			'action' => $this->generateUrl('schedule_edit', array('id' =>  $id)),
			'method' => 'POST',
		));

		$form->handleRequest($request);

		if ($form->isValid()){            
			$doctrine->flush();
			$this->sendMail($schedule->getId());
			return $this->redirect($this->generateUrl('schedule_confirm', array('id' => $schedule->getId())));
		}

		$ucb_patient_action = $this->container->getParameter('ucb_patient_login');
		return $this->render('MainBundle:Schedule:edit.html.twig', array(
			'schedule' => $schedule,
			'form'   => $form->createView(),
			'ucb_patient_action' => $ucb_patient_action
		));
	}

	public function listAction()
	{

		$owauuid 		= '';
		$owaonekeycode 	= '';
		if($this->get('security.context')->getToken()->getUser() instanceof OwaUser){
			$owauuid 		= $this->get('security.context')->getToken()->getUser()->getUuid();
			$owaonekeycode = $this->get('security.context')->getToken()->getUser()->getOnekeycode();
		}

		if($owauuid == '' && $owaonekeycode == '') {
			return $this->redirect($this->generateUrl('option'));
		}

		$doctrine = $this->getDoctrine()->getManager();
		$schedule = $doctrine->getRepository('MainBundle:Schedule')->findBy(array(
				'owaonekeycode' => $owaonekeycode),
			array('scheduledatetime' => 'ASC'));
		$ucb_patient_action = $this->container->getParameter('ucb_patient_login');
		return $this->render('MainBundle:Schedule:list.html.twig', array(
			'schedules' => $schedule,
			'ucb_patient_action' => $ucb_patient_action
		));
	}

	public function sendMail($schedule_id)
	{
		$owauser = '';
		if($this->get('security.context')->getToken()->getUser() instanceof OwaUser){
			$owauser = $this->get('security.context')->getToken()->getUser();
		}

		$ucb_patient_action = $this->container->getParameter('ucb_patient_login');

		$doctrine  = $this->getDoctrine()->getManager();
		$schedule  = $doctrine->getRepository('MainBundle:Schedule')->find($schedule_id);
		$hcpPatientConfirmationMailer       = $this->get('hcp_patient_confirmation_mailer');
		$sendHcpPatientConfirmationMailer   = $hcpPatientConfirmationMailer->sendMail($schedule,$owauser,$ucb_patient_action);

		$hcpConfirmationMailer       = $this->get('hcp_confirmation_mailer');
		$sendHcpConfirmationMailer   = $hcpConfirmationMailer->sendMail($schedule,$owauser,$ucb_patient_action);    

		if (true !== $sendHcpPatientConfirmationMailer && true !== $sendHcpConfirmationMailer){
			throw new \Exception('Send mail exception');
		}
	}

	public function scheduleConfirmAction(Request $request)
	{
		if($request->get('id') == '') {
			return $this->redirect($this->generateUrl('option'));
		}
		$doctrine  = $this->getDoctrine()->getManager();
		$schedule  = $doctrine->getRepository('MainBundle:Schedule')->find($request->get('id'));
		return $this->render('MainBundle:Schedule:schedule_confirm.html.twig', array(
				'firstname'   => $schedule->getFirstname(),
				'lastname'    => $schedule->getLastname(),
				'date'        => $schedule->getScheduledatetime()->format('Y/m/d'),
				'time'        => $schedule->getScheduledatetime()->format('h:i A'),
				'phone'       => $schedule->getPhone(),
			));
	}

	public function deleteAction(Request $request)
	{
		try {
			$schedule_id   = trim($request->request->get('schedule_id'));
			if ($schedule_id) {
				$doctrine = $this->getDoctrine()->getManager();
				$schedule = $doctrine->getRepository('MainBundle:Schedule')->find($schedule_id);
				$doctrine->remove($schedule);
				$doctrine->flush();
				$a_response['s_status'] = 'success';
				$a_response['data']     = '';
			} else {
				$a_response['s_status'] = 'error';
				$a_response['data']     = 'error';
			}
		} catch(Exception $e) {
			$a_response['s_status'] = 'error';
			$a_response['data'] = $e->getMessage();
		}
		return new JsonResponse($a_response);
	}
}