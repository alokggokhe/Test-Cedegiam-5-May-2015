<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ForgottenPasswordController extends Controller
{

	public function IndexAction()
    {	
    	$request = $this->get('request');
    	
    	$email = "";

    	if ($request->getMethod() == 'POST') {

        	$email = $request->get('email');

            if (!filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
			  	$request->getSession()->getFlashBag()->add('error', 'Please check your email address.');
			}
			else{
	    		try {

	            	$a = array('Email'=> $request->get('email'), 'language' => array('language' => 'en_AU'));
	            	
	            	$server = $this->container->getParameter('owa_forgot');
    		
	            	$client = new \SoapClient($server, array('trace' => 1));

	            	$response = $client->__soapCall('SendMailForgotPwd', array($a));
	            	
	            	if($response->return->returnCode){
			    		$request->getSession()->getFlashBag()->add('error', $response->return->errorMessage);
	              	}
	              	else{
	              		$request->getSession()->getFlashBag()->add('success', 'A new password has been sent to your email address.');
						return $this->redirectToRoute('homepage');

	              	}
			    } catch (\SoapFault $e) {
			    	$request->getSession()->getFlashBag()->add('error', $e->getMessage());
			    }
			}
    	}

    	$action = $this->generateUrl('forgotten_password');
        
        return $this->render('MainBundle:ForgottenPassword:forgotten.html.twig', array('action' => $action, 'email' => $email));
    }
}
