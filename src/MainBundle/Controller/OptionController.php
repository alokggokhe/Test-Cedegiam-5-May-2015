<?php

namespace MainBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cegedim\Bundle\OwaCasBundle\Security\User\OwaUser;

class OptionController extends Controller
{
	public function indexAction()
	{
		$name = '';
		$webinar_params = '';
		if($this->get('security.context')->getToken()->getUser() instanceof OwaUser){
			$name = $this->get('security.context')->getToken()->getUser()->getUsername();
			$firstname = $this->get('security.context')->getToken()->getUser()->getFirstname();

			$webinar_params = '?name='. $name .'&firstname='. $firstname;
		}
		
		return $this->render('MainBundle:Option:option.html.twig', array('name' => $name, 'webinar_params' => $webinar_params));
	}

	public function remotePatientAction()
	{
		$ucb_patient_params = '';
		$ucb_patient_action	= '';	

		if($this->get('security.context')->getToken()->getUser() instanceof OwaUser){
			$ucb_patient_params = '';
			$ucb_patient_action = $this->container->getParameter('ucb_patient_login') . $ucb_patient_params;
		}

		return $this->render('MainBundle:Option:remote_patient_option.html.twig', array( 
			'ucb_patient_action' => $ucb_patient_action));
	}
}
